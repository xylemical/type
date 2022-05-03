<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;

/**
 * Provides a boolean value.
 */
class BooleanType extends Type {

  /**
   * {@inheritdoc}
   */
  public static function getType(): string {
    return 'boolean';
  }

}
