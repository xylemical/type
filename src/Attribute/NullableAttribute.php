<?php

declare(strict_types=1);

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Constraint\NullableConstraint;

/**
 * Provides nullable behaviour.
 */
class NullableAttribute extends BooleanAttribute {

  /**
   * {@inheritdoc}
   */
  public function getValueConstraints(): array {
    $constraints = parent::getValueConstraints();
    $constraints[] = new NullableConstraint($this->getValue());
    return $constraints;
  }

}
