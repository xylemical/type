<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Constraint\InternalTypeConstraint;

/**
 * Provides an integer attribute.
 */
class IntegerAttribute extends NumericAttribute {

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(InternalTypeConstraint::class, 'int');
    return $constraints;
  }

}
