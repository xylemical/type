<?php

declare(strict_types=1);

namespace Xylemical\Type\Storage;

use Xylemical\Type\Event\ValueCreateInterface;
use Xylemical\Type\Event\ValueDeleteInterface;
use Xylemical\Type\Event\ValueLoadInterface;
use Xylemical\Type\Event\ValueUpdateInterface;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ValueFactoryInterface;
use Xylemical\Type\ValueInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\ViolationListInterface;

/**
 * Provide a base for type storage.
 */
abstract class AbstractStorage implements StorageInterface {

  /**
   * The value factory.
   *
   * @var \Xylemical\Type\ValueFactoryInterface
   */
  protected ValueFactoryInterface $valueFactory;

  /**
   * Storage constructor.
   *
   * @param \Xylemical\Type\ValueFactoryInterface $valueFactory
   *   The value factory.
   */
  public function __construct(ValueFactoryInterface $valueFactory) {
    $this->valueFactory = $valueFactory;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function applies(StoredTypeInterface $type): bool;

  /**
   * {@inheritdoc}
   */
  public function exists(StoredTypeInterface $type, string $id): bool {
    return $this->doExists($type, $id);
  }

  /**
   * {@inheritdoc}
   */
  public function load(StoredTypeInterface $type, string $id): ?StoredValueInterface {
    if ($value = $this->doLoad($type, $id)) {
      $this->doEvent($type, [$this, 'onLoad'], $value);
    }

    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public function create(StoredTypeInterface $type, array $values = []): ?StoredValueInterface {
    $value = $this->valueFactory->create($type, $values);
    if ($value instanceof StoredValueInterface) {
      $value->setStorage($this);
      return $value;
    }
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function save(StoredValueInterface $value): ViolationListInterface {
    $violations = $this->getViolationList();
    $type = $value->getType();
    $path = $type->getPath();

    $id = $type->getId($value);
    if ($id && ($original = $this->doLoad($type, $id))) {
      try {
        $this->doEvent($type, [$this, 'preUpdate'], $value, $original);
      }
      catch (\Throwable $e) {
        $violations->addViolation($path, $e->getMessage());
        return $violations;
      }

      if ($this->doUpdate($type, $value, $violations)) {
        $this->doEvent($type, [$this, 'onUpdate'], $value, $original);
      }
    }
    else {
      try {
        $this->doEvent($type, [$this, 'preCreate'], $value);
      }
      catch (\Throwable $e) {
        $violations->addViolation($path, $e->getMessage());
        return $violations;
      }

      if ($this->doCreate($type, $value, $violations)) {
        $this->doEvent($type, [$this, 'onCreate'], $value);
      }
    }
    return $violations;
  }

  /**
   * {@inheritdoc}
   */
  public function delete(StoredTypeInterface $type, string $id): ViolationListInterface {
    $violations = $this->getViolationList();
    $path = $type->getPath();
    if ($value = $this->doLoad($type, $id)) {
      try {
        $this->doEvent($type, [$this, 'preDelete'], $value);
      }
      catch (\Throwable $e) {
        $violations->addViolation($path, $e->getMessage());
        return $violations;
      }

      if ($this->doDelete($type, $value, $violations)) {
        $this->doEvent($type, [$this, 'onDelete'], $value);
      }
    }
    else {
      $violations->addViolation($path, 'Value did not exist.');
    }
    return $violations;
  }

  /**
   * Get the violation list.
   *
   * @return \Xylemical\Type\ViolationListInterface
   *   The violation list.
   */
  protected function getViolationList(): ViolationListInterface {
    return new ViolationList();
  }

  /**
   * Perform an event against a type.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   * @param callable $callable
   *   The callback to do the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ValueInterface|null $original
   *   The original value.
   */
  protected function doEvent(TypeInterface $type, callable $callable, ValueInterface $value, ?ValueInterface $original = NULL): void {
    $callable($type, $value, $original);
    foreach ($type->getAttributes() as $attribute) {
      $callable($attribute, $value, $original);
    }
    foreach ($type->getConstraints() as $constraint) {
      $callable($constraint, $value, $original);
    }
  }

  /**
   * Perform the functional implementation for an existence check on a value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param string $id
   *   The identifier.
   *
   * @return bool
   *   The result.
   */
  protected function doExists(StoredTypeInterface $type, string $id): bool {
    return FALSE;
  }

  /**
   * Performs the functional implementation of loading a value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param string $id
   *   The identifier.
   *
   * @return \Xylemical\Type\Storage\StoredValueInterface|null
   *   The value, or NULL.
   */
  protected function doLoad(StoredTypeInterface $type, string $id): ?StoredValueInterface {
    return NULL;
  }

  /**
   * Perform onLoad().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  protected function onLoad(object $item, ValueInterface $value): void {
    if ($item instanceof ValueLoadInterface) {
      $item->onLoad($value);
    }
  }

  /**
   * Perform the functional implementation of creation of a value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ViolationListInterface $violations
   *   The violations.
   *
   * @return bool
   *   Returns TRUE when there are no violations.
   */
  protected function doCreate(StoredTypeInterface $type, ValueInterface $value, ViolationListInterface $violations): bool {
    return !$violations->hasViolations();
  }

  /**
   * Perform preCreate().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   *
   * @throws \Throwable
   */
  protected function preCreate(object $item, ValueInterface $value): void {
    if ($item instanceof ValueCreateInterface) {
      $item->preCreate($value);
    }
  }

  /**
   * Perform onCreate().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  protected function onCreate(object $item, ValueInterface $value): void {
    if ($item instanceof ValueCreateInterface) {
      $item->onCreate($value);
    }
  }

  /**
   * Perform the functional implementation of updating a value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ViolationListInterface $violations
   *   The violations.
   *
   * @return bool
   *   Returns TRUE when there are no violations.
   */
  protected function doUpdate(StoredTypeInterface $type, ValueInterface $value, ViolationListInterface $violations): bool {
    return !$violations->hasViolations();
  }

  /**
   * Perform preDelete().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ValueInterface $original
   *   The original.
   *
   * @throws \Throwable
   */
  protected function preUpdate(object $item, ValueInterface $value, ValueInterface $original): void {
    if ($item instanceof ValueUpdateInterface) {
      $item->preUpdate($value, $original);
    }
  }

  /**
   * Perform onUpdate().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ValueInterface $original
   *   The original.
   */
  protected function onUpdate(object $item, ValueInterface $value, ValueInterface $original): void {
    if ($item instanceof ValueUpdateInterface) {
      $item->onUpdate($value, $original);
    }
  }

  /**
   * Perform the functional implementation of deleting a value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ViolationListInterface $violations
   *   The violations.
   *
   * @return bool
   *   Returns TRUE when there are no violations.
   */
  protected function doDelete(StoredTypeInterface $type, ValueInterface $value, ViolationListInterface $violations): bool {
    return !$violations->hasViolations();
  }

  /**
   * Perform preDelete().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   *
   * @throws \Throwable
   */
  protected function preDelete(object $item, ValueInterface $value): void {
    if ($item instanceof ValueDeleteInterface) {
      $item->preDelete($value);
    }
  }

  /**
   * Perform onDelete().
   *
   * @param object $item
   *   The object performing the event.
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  protected function onDelete(object $item, ValueInterface $value): void {
    if ($item instanceof ValueDeleteInterface) {
      $item->onDelete($value);
    }
  }

}
