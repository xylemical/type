<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;

/**
 * Provides an object type.
 */
class ObjectType extends Type {

  /**
   * {@inheritdoc}
   */
  public static function getType(): string {
    return 'object';
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultAttributes(): array {
    $attributes = parent::getDefaultAttributes();
    /*
    $constraints = [
    (new MapConstraint(new InternalTypeConstraint(TypeInterface::class)))
    ->setKeyConstraint(new InternalTypeConstraint('string')),
    ];

    $attributes['properties'] = (new MapAttribute(
    'properties',
    [],
    [PropertiesConstraint::getAttributeCallable()]
    ))->addConstraints($constraints);
     */
    return $attributes;
  }

}
