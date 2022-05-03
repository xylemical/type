<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Attribute;
use Xylemical\Type\Constraint\InternalTypeConstraint;

/**
 * Provides a boolean attribute.
 */
class BooleanAttribute extends Attribute {

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(InternalTypeConstraint::class, 'bool');
    return $constraints;
  }

}
