<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a base constraint definition.
 */
abstract class AbstractConstraint implements ConstraintInterface {

  /**
   * The setting used to determine the constraint result.
   *
   * @var mixed
   */
  protected mixed $setting;

  /**
   * {@inheritdoc}
   */
  public function __construct(mixed $setting = NULL) {
    $this->setting = $setting;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(mixed $value): bool {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function isConstrained(mixed $value, PathInterface $context, ViolationListInterface $violations): bool;

}
