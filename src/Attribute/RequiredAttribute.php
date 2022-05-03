<?php

declare(strict_types=1);

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Constraint\RequiredConstraint;

/**
 * Provides required value behaviour.
 */
class RequiredAttribute extends BooleanAttribute {

  /**
   * {@inheritdoc}
   */
  public function getValueConstraints(): array {
    $constraints = parent::getValueConstraints();
    $constraints[] = new RequiredConstraint($this->getValue());
    return $constraints;
  }

}
