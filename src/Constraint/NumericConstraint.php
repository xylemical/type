<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check the value is numeric.
 */
class NumericConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (!is_numeric($value) || is_string($value)) {
      $violations->addViolation(
        $context,
        'Value needs to be a number.',
      );
      return FALSE;
    }
    return TRUE;
  }

}
