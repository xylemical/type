<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provide a violation list.
 */
class ViolationList implements ViolationListInterface, \IteratorAggregate {

  /**
   * The violations.
   *
   * @var \Xylemical\Type\ViolationInterface[]
   */
  protected array $violations = [];

  /**
   * {@inheritdoc}
   */
  public function __construct(array $violations = []) {
    $this->violations = $violations;
  }

  /**
   * {@inheritdoc}
   */
  public function hasViolations(): bool {
    return count($this->violations) > 0;
  }

  /**
   * {@inheritdoc}
   */
  public function getViolations(): array {
    return $this->violations;
  }

  /**
   * {@inheritdoc}
   */
  public function addViolation(PathInterface $context, string $message, array $arguments = []): static {
    $this->violations[] = new Violation(
      $context->getLocation(),
      $message,
      $arguments
    );
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return count($this->violations);
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->violations);
  }

}
