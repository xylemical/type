<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check value matches a pattern.
 */
class PatternConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function applies(mixed $value): bool {
    return is_string($value) ||
      (is_object($value) && method_exists($value, '__toString'));
  }

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if ($this->setting && !preg_match($this->setting, (string) $value)) {
      $violations->addViolation($context, 'Value does not match pattern.');
      return FALSE;
    }
    return TRUE;
  }

}
