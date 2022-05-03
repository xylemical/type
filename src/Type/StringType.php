<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;

/**
 * Provides a string type.
 */
class StringType extends Type {

  /**
   * {@inheritdoc}
   */
  public static function getType(): string {
    return 'string';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultAttributes(): array {
    $attributes = parent::getDefaultAttributes();
    /*
    $attributes[] = new StringAttribute('pattern', NULL, [
    PatternConstraint::getAttributeCallable(),
    ]);
    $strlen = function_exists('mb_strlen') ? 'mb_strlen' : 'strlen';
    $attributes[] = new IntegerAttribute('minLength', NULL,
    [CompareConstraint::getCallable('>=', $strlen)]
    );
    $attributes[] = new IntegerAttribute('maxLength', NULL,
    [CompareConstraint::getCallable('<=', $strlen)]
    );
     */
    return $attributes;
  }

}
