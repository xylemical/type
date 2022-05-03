<?php

declare(strict_types=1);

namespace Xylemical\Type\Storage;

use Xylemical\Type\Value;

/**
 * Provides a stored value.
 */
class StoredValue extends Value implements StoredValueInterface {

  /**
   * The storage.
   *
   * @var \Xylemical\Type\Storage\StorageInterface|null
   */
  protected ?StorageInterface $storage = NULL;

  /**
   * {@inheritdoc}
   */
  public function getStorage(): ?StorageInterface {
    return $this->storage;
  }

  /**
   * {@inheritdoc}
   */
  public function setStorage(?StorageInterface $storage): static {
    $this->storage = $storage;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function reset(): static {
    $type = $this->getType();
    if ($this->storage and $type instanceof StoredTypeInterface) {
      $value = $this->storage->load($type, $type->getId($this));
      $this->value = $value->get();
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function save(): static {
    $type = $this->getType();
    if ($this->storage and $type instanceof StoredTypeInterface) {
      $this->storage->save($this);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function delete(): static {
    $type = $this->getType();
    if ($this->storage and $type instanceof StoredTypeInterface) {
      $this->storage->delete($type, $type->getId($this));
    }
    return $this;
  }

}
