<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provide a context for the constraint operations.
 */
class Path implements PathInterface {

  /**
   * The type.
   *
   * @var \Xylemical\Type\TypeInterface
   */
  protected TypeInterface $type;

  /**
   * The parent type.
   *
   * @var \Xylemical\Type\TypeInterface|null
   */
  protected ?TypeInterface $parent;

  /**
   * Path constructor.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   * @param \Xylemical\Type\TypeInterface|null $parent
   *   The parent.
   */
  public function __construct(TypeInterface $type, ?TypeInterface $parent = NULL) {
    $this->type = $type;
    $this->parent = $parent;
  }

  /**
   * {@inheritdoc}
   */
  public function getLocation(): string {
    $type = $this->type->getName();
    if ($this->parent) {
      return $this->parent->getPath()->getLocation() . '.' . $type;
    }
    return $type;
  }

  /**
   * {@inheritdoc}
   */
  public function getType(): TypeInterface {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function getParent(): ?TypeInterface {
    return $this->parent;
  }

  /**
   * {@inheritdoc}
   */
  public function setParent(?TypeInterface $parent): static {
    $this->parent = $parent;
    return $this;
  }

}
