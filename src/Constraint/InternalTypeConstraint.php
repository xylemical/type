<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check value against an internal type.
 */
class InternalTypeConstraint extends AbstractConstraint {

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    switch ($this->setting) {
      case NULL:
        break;

      case 'boolean':
      case 'bool':
        if (!is_bool($value)) {
          $violations->addViolation($context, 'Value needs to be a boolean.');
          return FALSE;
        }
        break;

      case 'integer':
      case 'int':
        if (!is_int($value)) {
          $violations->addViolation($context, 'Value needs to be an integer.');
          return FALSE;
        }
        break;

      case 'float':
      case 'double':
        if (!is_float($value)) {
          $violations->addViolation($context, 'Value needs to be a float.');
          return FALSE;
        }
        break;

      case 'string':
        if (!is_string($value)) {
          $violations->addViolation($context, 'Value needs to be a string.');
          return FALSE;
        }
        break;

      case 'array':
        if (!is_array($value)) {
          $violations->addViolation($context, 'Value needs to be an array.');
          return FALSE;
        }
        break;

      case 'object':
        if (!is_object($value)) {
          $violations->addViolation($context, 'Value needs to be an object.');
          return FALSE;
        }
        break;

      // Assume anything else is an object type.
      default:
        $isClass = is_string($this->setting) && class_exists($this->setting);
        if ($isClass && !($value instanceof $this->setting)) {
          $violations->addViolation(
            $context,
            'Value needs to be an instance of %s.',
            [$this->setting]
          );
          return FALSE;
        }
    }

    return TRUE;
  }

}
