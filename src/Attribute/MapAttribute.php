<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Attribute;
use Xylemical\Type\Constraint\InternalTypeConstraint;

/**
 * Provides a map attribute.
 */
class MapAttribute extends Attribute {

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(InternalTypeConstraint::class, 'array');
    return $constraints;
  }

}
