<?php

declare(strict_types=1);

namespace Xylemical\Type\Type;

use Xylemical\Type\Type;
use Xylemical\Type\TypeInterface;

/**
 * Provides a base class for combined multiple types.
 */
abstract class AbstractMultiType extends Type {

  /**
   * The types that make up this type.
   *
   * @var \Xylemical\Type\TypeInterface[]
   */
  protected array $types = [];

  /**
   * Get the types.
   *
   * @return \Xylemical\Type\TypeInterface[]
   *   The types.
   */
  public function getTypes(): array {
    return $this->types;
  }

  /**
   * Set multiple types.
   *
   * @param \Xylemical\Type\TypeInterface[] $types
   *   The types.
   *
   * @return $this
   */
  public function setTypes(array $types): static {
    $this->types = [];
    return $this->addTypes($types);
  }

  /**
   * Add multiple types.
   *
   * @param \Xylemical\Type\TypeInterface[] $types
   *   The types.
   *
   * @return $this
   */
  public function addTypes(array $types): static {
    foreach ($types as $type) {
      $this->addType($type);
    }
    return $this;
  }

  /**
   * Add a type.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   *
   * @return $this
   */
  public function addType(TypeInterface $type): static {
    $this->types[] = $type;
    return $this;
  }

  /**
   * Remove a type.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   *
   * @return $this
   */
  public function removeType(TypeInterface $type): static {
    $this->types = array_filter($this->types, function ($item) use ($type) {
      return $item !== $type;
    });
    return $this;
  }

}
