<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a violation list.
 */
interface ViolationListInterface extends \Countable, \Traversable {

  /**
   * Check the list has violations.
   *
   * @return bool
   *   The result.
   */
  public function hasViolations(): bool;

  /**
   * Get the violations.
   *
   * @return \Xylemical\Type\ViolationInterface[]
   *   The violations.
   */
  public function getViolations(): array;

  /**
   * Add another violation to the list.
   *
   * @param \Xylemical\Type\PathInterface $context
   *   The context of the violation.
   * @param string $message
   *   The message.
   * @param array $arguments
   *   The arguments.
   *
   * @return $this
   */
  public function addViolation(PathInterface $context, string $message, array $arguments = []): static;

}
