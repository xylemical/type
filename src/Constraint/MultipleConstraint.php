<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check the value is a multiple of another value.
 */
class MultipleConstraint extends AbstractConstraint {

  /**
   * The margin within which to check the result.
   *
   * @var float
   */
  protected float $margin = 0.000000001;

  /**
   * Get the margin for checking valid modulus of float.
   *
   * @return float
   *   The margin.
   */
  public function getMargin(): float {
    return $this->margin;
  }

  /**
   * Set the margin for checking valid modulus of float.
   *
   * @param float $margin
   *   The margin.
   *
   * @return $this
   */
  public function setMargin(float $margin): static {
    $this->margin = $margin;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(mixed $value): bool {
    return is_numeric($value);
  }

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (!is_null($this->setting) && $this->setting > 0) {
      if (is_float($this->setting)) {
        $margin = $this->margin;
        $mod = fmod($value, $this->setting);
        $violation = !(($mod < $margin) || ($mod + $margin >= $this->setting));
      }
      else {
        $violation = ($value % $this->setting !== 0);
      }
      if ($violation) {
        $violations->addViolation(
          $context,
          'Value is not a multiple of %d.',
          [$this->setting]
        );
        return FALSE;
      }
    }
    return TRUE;
  }

}
