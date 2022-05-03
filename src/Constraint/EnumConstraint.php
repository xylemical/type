<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check value against a list of values.
 */
class EnumConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (is_array($this->setting)) {
      foreach ($this->setting as $setting) {
        if ($setting === $value) {
          return TRUE;
        }
      }
      $violations->addViolation($context, 'Value is not allowed.');
      return FALSE;
    }
    return TRUE;
  }

}
