<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic validator.
 */
class Validator implements ValidatorInterface {

  /**
   * The type.
   *
   * @var \Xylemical\Type\TypeInterface
   */
  protected TypeInterface $type;

  /**
   * The violations.
   *
   * @var \Xylemical\Type\ViolationListInterface
   */
  protected ViolationListInterface $violations;

  /**
   * Validator constructor.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   */
  public function __construct(TypeInterface $type) {
    $this->type = $type;
    $this->violations = new ViolationList();
  }

  /**
   * {@inheritdoc}
   */
  public function validate(mixed $value): bool {
    $path = $this->type->getPath();
    $this->violations = new ViolationList();
    foreach ($this->type->getConstraints() as $constraint) {
      if ($constraint->applies($value)) {
        if (!$constraint->isConstrained($value, $path, $this->violations)) {
          return FALSE;
        }
      }
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function hasViolations(): bool {
    return $this->violations->hasViolations();
  }

  /**
   * {@inheritdoc}
   */
  public function getViolations(): ViolationListInterface {
    return $this->violations;
  }

}
