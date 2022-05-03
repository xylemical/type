<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides the constraint against a value.
 */
interface ConstraintInterface {

  /**
   * ConstraintInterface constructor.
   *
   * @param mixed $setting
   *   The setting.
   */
  public function __construct(mixed $setting);

  /**
   * Checks the constraint applies to the value.
   *
   * @param mixed $value
   *   The value.
   *
   * @return bool
   *   The result.
   */
  public function applies(mixed $value): bool;

  /**
   * Check the value is constrained.
   *
   * @param mixed $value
   *   The value.
   * @param \Xylemical\Type\PathInterface $context
   *   The context of the constraint.
   * @param \Xylemical\Type\ViolationListInterface $violations
   *   The violations.
   *
   * @return bool
   *   The result.
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool;

}
