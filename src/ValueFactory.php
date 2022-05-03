<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a generic value factory.
 */
class ValueFactory implements ValueFactoryInterface {

  /**
   * {@inheritdoc}
   */
  public function create(TypeInterface $type, mixed $value): ValueInterface {
    return new Value($type, $value);
  }

}
