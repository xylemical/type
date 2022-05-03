<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic attribute factory.
 */
class AttributeFactory implements AttributeFactoryInterface {

  /**
   * The constraint factory.
   *
   * @var \Xylemical\Type\ConstraintFactoryInterface
   */
  protected ConstraintFactoryInterface $constraintFactory;

  /**
   * AttributeFactory constructor.
   *
   * @param \Xylemical\Type\ConstraintFactoryInterface $constraintFactory
   *   The constraint factory.
   */
  public function __construct(ConstraintFactoryInterface $constraintFactory) {
    $this->constraintFactory = $constraintFactory;
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
  public function setConstraintFactory(ConstraintFactoryInterface $constraintFactory): static {
    $this->constraintFactory = $constraintFactory;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function create(string $attribute, string $name, mixed $value): AttributeInterface {
    return new $attribute($name, $value, $this->constraintFactory);
  }

}
