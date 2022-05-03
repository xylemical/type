<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides for a value to be created from a type.
 */
interface ValueFactoryInterface {

  /**
   * Create a value from a type.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   * @param mixed $value
   *   The value for the type.
   *
   * @return \Xylemical\Type\ValueInterface
   *   The value.
   */
  public function create(TypeInterface $type, mixed $value): ValueInterface;

}
