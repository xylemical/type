<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a value definition.
 */
interface ValueInterface {

  /**
   * ValueInterface constructor.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   * @param mixed|null $value
   *   The initial value or NULL.
   */
  public function __construct(TypeInterface $type, mixed $value = NULL);

  /**
   * Get the type representing the value.
   *
   * @return \Xylemical\Type\TypeInterface
   *   The type.
   */
  public function getType(): TypeInterface;

  /**
   * Get the value.
   *
   * @return mixed
   *   The value.
   */
  public function get(): mixed;

  /**
   * Set the value.
   *
   * @param mixed $value
   *   The value.
   *
   * @return $this
   */
  public function set(mixed $value): static;

}
