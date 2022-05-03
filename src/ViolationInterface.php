<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides for validation errors.
 */
interface ViolationInterface {

  /**
   * Get the location of the violation.
   *
   * @return string
   *   The context of the violation.
   */
  public function getPath(): string;

  /**
   * Get the message of the violation.
   *
   * @return string
   *   The message.
   */
  public function getMessage(): string;

  /**
   * Get the message arguments for the violation.
   *
   * @return array
   *   The arguments.
   */
  public function getArguments(): array;

}
