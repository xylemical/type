<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a type factory.
 */
interface TypeFactoryInterface {

  /**
   * Create a type from the given details.
   *
   * @param string $type
   *   The name.
   * @param array $attributes
   *   The attribute values.
   *
   * @return \Xylemical\Type\TypeInterface|null
   *   The type.
   */
  public function create(string $type, array $attributes = []): ?TypeInterface;

}
