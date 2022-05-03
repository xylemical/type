<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a multiple constraint.
 */
class Constraint implements ConstraintInterface {

  /**
   * The constraints.
   *
   * @var \Xylemical\Type\ConstraintInterface[]
   */
  protected array $constraints = [];

  /**
   * The check all constraints flag.
   *
   * @var bool
   */
  protected bool $allConstraints;

  /**
   * {@inheritdoc}
   */
  public function __construct(mixed $setting = NULL) {
    $this->allConstraints = (bool) $setting;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(mixed $value): bool {
    foreach ($this->constraints as $constraint) {
      if ($constraint->applies($value)) {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool {
    $result = FALSE;
    foreach ($this->constraints as $constraint) {
      if (!$constraint->applies($value)) {
        continue;
      }
      if ($constraint->isConstrained($value, $context, $violations)) {
        continue;
      }
      $result = TRUE;
      if (!$this->allConstraints) {
        return TRUE;
      }
    }
    return $result;
  }

  /**
   * Get the constraints.
   *
   * @return \Xylemical\Type\ConstraintInterface[]
   *   The constraint.
   */
  public function getConstraints(): array {
    return $this->constraints;
  }

  /**
   * Set the constraints.
   *
   * @param \Xylemical\Type\ConstraintInterface[] $constraints
   *   The constraints.
   *
   * @return $this
   */
  public function setConstraints(array $constraints): static {
    $this->constraints = [];
    $this->addConstraints($constraints);
    return $this;
  }

  /**
   * Add constraints.
   *
   * @param \Xylemical\Type\ConstraintInterface[] $constraints
   *   The constraints.
   *
   * @return $this
   */
  public function addConstraints(array $constraints): static {
    foreach ($constraints as $constraint) {
      $this->addConstraint($constraint);
    }
    return $this;
  }

  /**
   * Add constraint.
   *
   * @param \Xylemical\Type\ConstraintInterface $constraint
   *   The constraint.
   *
   * @return $this
   */
  public function addConstraint(ConstraintInterface $constraint): static {
    $this->constraints[] = $constraint;
    return $this;
  }

}
