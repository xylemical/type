<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Defines attributes that can be applied to type.
 */
interface AttributeInterface {

  /**
   * AttributeInterface constructor.
   *
   * @param string $name
   *   The name.
   * @param mixed $value
   *   The value.
   * @param \Xylemical\Type\ConstraintFactoryInterface $constraintFactory
   *   The constraint factory.
   */
  public function __construct(string $name, mixed $value, ConstraintFactoryInterface $constraintFactory);

  /**
   * Get the name of the attribute.
   *
   * @return string
   *   The attribute name.
   */
  public function getName(): string;

  /**
   * Get the value of the attribute.
   *
   * @return mixed
   *   The value.
   */
  public function getValue(): mixed;

  /**
   * Set the value of the attribute.
   *
   * @param mixed $value
   *   The value.
   *
   * @return $this
   */
  public function setValue(mixed $value): static;

  /**
   * Get the constraint factory.
   *
   * @return \Xylemical\Type\ConstraintFactoryInterface
   *   The constraint factory.
   */
  public function getConstraintFactory(): ConstraintFactoryInterface;

  /**
   * Get the constraints for the attribute value.
   *
   * @return \Xylemical\Type\ConstraintInterface[]
   *   The constraints.
   */
  public function getConstraints(): array;

  /**
   * Get the value constraints.
   *
   * @return \Xylemical\Type\ConstraintInterface[]
   *   The constraints.
   */
  public function getValueConstraints(): array;

}
