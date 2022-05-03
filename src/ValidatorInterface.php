<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides validation of a type value.
 */
interface ValidatorInterface {

  /**
   * ValidatorInterface constructor.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   */
  public function __construct(TypeInterface $type);

  /**
   * Validates a value.
   *
   * @param mixed $value
   *   The value.
   *
   * @return bool
   *   The result.
   */
  public function validate(mixed $value): bool;

  /**
   * Check there are violations.
   *
   * @return bool
   *   The result.
   */
  public function hasViolations(): bool;

  /**
   * Get the violations.
   *
   * @return \Xylemical\Type\ViolationListInterface
   *   The violations list.
   */
  public function getViolations(): ViolationListInterface;

}
