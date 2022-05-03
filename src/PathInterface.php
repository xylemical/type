<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides path identification of a type.
 */
interface PathInterface {

  /**
   * Get the path location as a string.
   *
   * @return string
   *   The path.
   */
  public function getLocation(): string;

  /**
   * Get the type represented by this path.
   *
   * @return \Xylemical\Type\TypeInterface
   *   The type.
   */
  public function getType(): TypeInterface;

  /**
   * The parent type of the type.
   *
   * @return \Xylemical\Type\TypeInterface|null
   *   The parent or NULL.
   */
  public function getParent(): ?TypeInterface;

  /**
   * Set the parent type for this path.
   *
   * @param \Xylemical\Type\TypeInterface|null $parent
   *   The parent type or NULL.
   *
   * @return $this
   */
  public function setParent(?TypeInterface $parent): static;

}
