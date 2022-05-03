<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Constraint\InternalTypeConstraint;

/**
 * Provides a double/float attribute.
 */
class FloatAttribute extends NumericAttribute {

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(InternalTypeConstraint::class, 'float');
    return $constraints;
  }

}
