<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check value is null or not.
 */
class NullableConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (is_null($value) && !$this->setting) {
      $violations->addViolation($context, 'Cannot be null.');
      return FALSE;
    }
    return TRUE;
  }

}
