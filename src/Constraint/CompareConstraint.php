<?php

namespace Xylemical\Type\Constraint;

use Xylemical\Type\AbstractConstraint;
use Xylemical\Type\PathInterface;
use Xylemical\Type\ViolationListInterface;

/**
 * Check value compares against a value.
 */
class CompareConstraint extends AbstractConstraint {

  /**
   * The callable to filter the value.
   *
   * @var callable|null
   */
  protected $filter = NULL;

  /**
   * The operation to compare with.
   *
   * @var string
   */
  protected string $operation = '=';

  /**
   * Get the value callable.
   *
   * @return callable
   *   The callable.
   */
  public function getFilter(): callable {
    return $this->filter;
  }

  /**
   * Set the value callable.
   *
   * @param callable|null $filter
   *   The filter.
   *
   * @return $this
   */
  public function setFilter(?callable $filter): static {
    $this->filter = $filter;
    return $this;
  }

  /**
   * Get the operation.
   *
   * @return string
   *   The operation.
   */
  public function getOperation(): string {
    return $this->operation;
  }

  /**
   * Set the operation.
   *
   * @param string $operation
   *   The operation.
   *
   * @return $this
   */
  public function setOperation(string $operation): static {
    $this->operation = $operation;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    if (!$this->check($value)) {
      $violations->addViolation(
        $context,
        'Value was not %s than %d',
        [$this->operation, $this->setting],
      );
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Check the value against function and operation.
   *
   * @param mixed $value
   *   The value.
   *
   * @return bool
   *   The result.
   */
  protected function check(mixed $value): bool {
    if ($this->filter) {
      $value = call_user_func($this->filter, $value);
    }

    return match ($this->operation) {
      '!', '!=' => $this->setting != $value,
      '<' => $value < $this->setting,
      '<=' => $value <= $this->setting,
      '>' => $value > $this->setting,
      '>=' => $value >= $this->setting,
      default => $value == $this->setting,
    };
  }

  /**
   * Create a callable using the operation and function settings.
   *
   * @param string $operation
   *   The operation to perform.
   * @param callable|null $callable
   *   The callable to run on the value.
   *
   * @return callable
   *   The callable.
   */
  public static function getCallable(string $operation, ?callable $callable = NULL): callable {
    return function ($setting) use ($operation, $callable) {
      return (new static($setting))
        ->setFilter($callable)
        ->setOperation($operation);
    };
  }

}
