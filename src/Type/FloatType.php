<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;

/**
 * Provides a float type.
 */
class FloatType extends Type {

  /**
   * {@inheritdoc}
   */
  public static function getType(): string {
    return 'float';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultAttributes(): array {
    $attributes = parent::getDefaultAttributes();
    /*
    $attributes['multipleOf'] = new FloatAttribute(
    'multipleOf',
    NULL,
    [MultipleConstraint::getAttributeCallable()]
    );
    $attributes['minimum'] = new FloatAttribute(
    'minimum',
    NULL,
    [CompareConstraint::getCallable('>=')]
    );
    $attributes['maximum'] = new FloatAttribute(
    'maximum',
    NULL,
    [CompareConstraint::getCallable('<=')]
    );
    $attributes['exclusiveMinimum'] = new FloatAttribute(
    'exclusiveMinimum',
    NULL,
    [CompareConstraint::getCallable('>')]
    );
    $attributes['exclusiveMaximum'] = new FloatAttribute(
    'exclusiveMaximum',
    NULL,
    [CompareConstraint::getCallable('<')]
    );
     */
    return $attributes;
  }

}
