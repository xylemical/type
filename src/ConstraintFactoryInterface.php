<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides for creation of constraints.
 */
interface ConstraintFactoryInterface {

  /**
   * Create a constraint based on class and setting.
   *
   * @codingStandardsIgnoreStart
   *
   * @param class-string<T> $constraint
   *   The constraint class
   * @param mixed $setting
   *   The setting or NULL.
   *
   * @template T of \Xylemical\Type\ConstraintInterface
   *
   * @return T
   *
   * @codingStandardsIgnoreEnd
   */
  public function create(string $constraint, mixed $setting = NULL): ConstraintInterface;

}
