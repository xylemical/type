<?php

declare(strict_types=1);

namespace Xylemical\Type;

use Xylemical\Type\Attribute\NullableAttribute;
use Xylemical\Type\Attribute\RequiredAttribute;

/**
 * Provides a base type.
 */
abstract class Type implements TypeInterface {

  /**
   * The name of the type.
   *
   * @var string
   */
  protected string $name = '';

  /**
   * The path of the type.
   *
   * @var \Xylemical\Type\PathInterface
   */
  protected PathInterface $path;

  /**
   * The attribute factory.
   *
   * @var \Xylemical\Type\AttributeFactoryInterface
   */
  protected AttributeFactoryInterface $attributeFactory;

  /**
   * The attributes of the type.
   *
   * @var \Xylemical\Type\AttributeInterface[]
   */
  protected array $attributes;

  /**
   * The constraints of the type.
   *
   * @var \Xylemical\Type\ConstraintInterface[]
   */
  protected array $constraints;

  /**
   * {@inheritdoc}
   */
  public function __construct(AttributeFactoryInterface $attributeFactory, array $settings = []) {
    $this->attributeFactory = $attributeFactory;
    $this->getAttributes();
    $this->setAttributes($settings);
  }

  /**
   * {@inheritdoc}
   */
  public function getPath(): PathInterface {
    if (!isset($this->path)) {
      $this->path = new Path($this, NULL);
    }
    return $this->path;
  }

  /**
   * {@inheritdoc}
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function setName(string $name): static {
    $this->name = $name;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getAttributes(): array {
    if (!isset($this->attributes)) {
      $this->attributes = [];
      foreach ($this->getDefaultAttributes() as $attribute) {
        $this->attributes[$attribute->getName()] = $attribute;
      }
    }
    return $this->attributes;
  }

  /**
   * {@inheritdoc}
   */
  public function getAttribute(string $name): ?AttributeInterface {
    return $this->attributes[$name] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function hasAttribute(string $name): bool {
    return isset($this->attributes[$name]);
  }

  /**
   * {@inheritdoc}
   */
  public function setAttributes(array $attributes): static {
    foreach ($attributes as $name => $value) {
      $this->setAttribute($name, $value);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setAttribute(string $name, mixed $value): static {
    if (isset($this->attributes[$name])) {
      $this->attributes[$name]->setValue($value);

      // Changing an attribute value can change the constraints.
      unset($this->constraints);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    if (!isset($this->constraints)) {
      $constraints = array_values($this->getDefaultConstraints());
      foreach ($this->getAttributes() as $attribute) {
        $constraints = array_merge($constraints, $attribute->getValueConstraints());
      }
      $this->constraints = $constraints;
    }
    return $this->constraints;
  }

  /**
   * Get the default attributes of the type.
   *
   * @return \Xylemical\Type\AttributeInterface[]
   *   The attributes.
   */
  protected function getDefaultAttributes(): array {
    $factory = $this->attributeFactory;
    return [
      'required' => $factory->create(RequiredAttribute::class, 'required', FALSE),
      'nullable' => $factory->create(NullableAttribute::class, 'nullable', FALSE),
    ];
  }

  /**
   * Get the default constraints of the type.
   *
   * @return \Xylemical\Type\ConstraintInterface[]
   *   The constraints.
   */
  protected function getDefaultConstraints(): array {
    return [];
  }

}
