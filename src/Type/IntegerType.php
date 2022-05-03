<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;

/**
 * Provides an integer type.
 */
class IntegerType extends Type {

  /**
   * {@inheritdoc}
   */
  public static function getType(): string {
    return 'integer';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultAttributes(): array {
    $attributes = parent::getDefaultAttributes();
    /*
    $attributes['multipleOf'] = new IntegerAttribute(
    'multipleOf',
    NULL,
    [MultipleConstraint::getAttributeCallable()]
    );
    $attributes['minimum'] = new IntegerAttribute(
    'minimum',
    NULL,
    [CompareConstraint::getCallable('>=')]
    );
    $attributes['maximum'] = new IntegerAttribute(
    'maximum',
    NULL,
    [CompareConstraint::getCallable('<=')]
    );
    $attributes['exclusiveMinimum'] = new IntegerAttribute(
    'exclusiveMinimum',
    NULL,
    [CompareConstraint::getCallable('>')]
    );
    $attributes['exclusiveMaximum'] = new IntegerAttribute(
    'exclusiveMaximum',
    NULL,
    [CompareConstraint::getCallable('>=')]
    );
     */
    return $attributes;
  }

}
