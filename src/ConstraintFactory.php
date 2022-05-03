<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic implementation of ConstraintFactoryInterface.
 */
class ConstraintFactory implements ConstraintFactoryInterface {

  /**
   * {@inheritdoc}
   */
  public function create(string $type, mixed $setting = NULL): ConstraintInterface {
    return new $type($setting);
  }

}
