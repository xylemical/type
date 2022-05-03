<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic violation.
 */
class Violation implements ViolationInterface {

  /**
   * The location of the violation.
   *
   * @var string
   */
  protected string $path;

  /**
   * The message.
   *
   * @var string
   */
  protected string $message;

  /**
   * The arguments.
   *
   * @var array
   */
  protected array $arguments;

  /**
   * Violation constructor.
   *
   * @param string $path
   *   The path.
   * @param string $message
   *   The message.
   * @param array $arguments
   *   The arguments.
   */
  public function __construct(string $path, string $message, array $arguments = []) {
    $this->path = $path;
    $this->message = $message;
    $this->arguments = $arguments;
  }

  /**
   * {@inheritdoc}
   */
  public function getPath(): string {
    return $this->path;
  }

  /**
   * {@inheritdoc}
   */
  public function getMessage(): string {
    return $this->message;
  }

  /**
   * {@inheritdoc}
   */
  public function getArguments(): array {
    return $this->arguments;
  }

}
