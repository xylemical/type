<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check the value is required.
 */
class RequiredConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (!$value && $this->setting) {
      $violations->addViolation($context, 'Value is required.');
      return FALSE;
    }
    return TRUE;
  }

}
