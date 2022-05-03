<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides for the creation of attributes.
 */
interface AttributeFactoryInterface {

  /**
   * Get the constraint factory.
   *
   * @return \Xylemical\Type\ConstraintFactoryInterface
   *   The constraint factory.
   */
  public function getConstraintFactory(): ConstraintFactoryInterface;

  /**
   * Set the constraint factory.
   *
   * @param \Xylemical\Type\ConstraintFactoryInterface $constraintFactory
   *   The constraint factory.
   *
   * @return $this
   */
  public function setConstraintFactory(ConstraintFactoryInterface $constraintFactory): static;

  /**
   * Create an attribute based on class and settings.
   *
   * @codingStandardsIgnoreStart
   *
   * @param class-string<T> $attribute
   *   The attribute class
   * @param string $name
   *   The attribute name.
   * @param mixed $value
   *   The attribute value.
   *
   * @template T of \Xylemical\Type\AttributeInterface
   *
   * @return T
   *
   * @codingStandardsIgnoreEnd
   */
  public function create(string $attribute, string $name, mixed $value): AttributeInterface;

}
