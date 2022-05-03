<?php

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Attribute;
use Xylemical\Type\Constraint\InternalTypeConstraint;
use Xylemical\Type\Constraint\PatternConstraint;

/**
 * Provides a string attribute.
 */
class StringAttribute extends Attribute {

  /**
   * The string attribute pattern.
   *
   * @var string
   */
  protected string $pattern = '';

  /**
   * Set the pattern used to validate the string attribute.
   *
   * @return string
   *   The pattern.
   */
  public function getPattern(): string {
    return $this->pattern;
  }

  /**
   * Set the PCRE pattern to verify the attribute value.
   *
   * @param string $pattern
   *   The pattern.
   *
   * @return $this
   */
  public function setPattern(string $pattern): static {
    $this->pattern = $pattern;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints(): array {
    $factory = $this->getConstraintFactory();
    $constraints = parent::getConstraints();
    $constraints[] = $factory->create(InternalTypeConstraint::class, 'string');
    if ($this->pattern) {
      $constraints[] = $factory->create(PatternConstraint::class, $this->pattern);
    }
    return $constraints;
  }

}
