<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Attribute;
use Xylemical\Type\Constraint\NumericConstraint;

/**
 * Provides a numeric attribute (can be integer or float).
 */
class NumericAttribute extends Attribute {

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(NumericConstraint::class);
    return $constraints;
  }

}
