<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic attribute.
 */
class Attribute implements AttributeInterface {

  /**
   * The attribute name.
   *
   * @var string
   */
  protected string $name;

  /**
   * The attribute value.
   *
   * @var mixed
   */
  protected mixed $value;

  /**
   * The constraint factory.
   *
   * @var \Xylemical\Type\ConstraintFactoryInterface
   */
  protected ConstraintFactoryInterface $constraintFactory;

  /**
   * Attribute constructor.
   *
   * @param string $name
   *   The name.
   * @param mixed $value
   *   The value.
   * @param \Xylemical\Type\ConstraintFactoryInterface $constraintFactory
   *   The constraint factory.
   */
  public function __construct(string $name, mixed $value, ConstraintFactoryInterface $constraintFactory) {
    $this->name = $name;
    $this->value = $value;
    $this->constraintFactory = $constraintFactory;
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
  public function getValue(): mixed {
    return $this->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue(mixed $value): static {
    $this->value = $value;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraintFactory(): ConstraintFactoryInterface {
    return $this->constraintFactory;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getValueConstraints(): array {
    return [];
  }

}
