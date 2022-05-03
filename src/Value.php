<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides a value.
 */
class Value implements ValueInterface {

  /**
   * The type.
   *
   * @var \Xylemical\Type\TypeInterface
   */
  protected TypeInterface $type;

  /**
   * The value.
   *
   * @var mixed
   */
  protected mixed $value;

  /**
   * Value constructor.
   *
   * @param \Xylemical\Type\TypeInterface $type
   *   The type.
   * @param mixed|null $value
   *   The value.
   */
  public function __construct(TypeInterface $type, mixed $value = NULL) {
    $this->type = $type;
    $this->set($value);
    if (!array_key_exists('value', get_object_vars($this))) {
      throw new \InvalidArgumentException();
    }
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
  public function get(): mixed {
    return $this->value;
  }

  /**
   * {@inheritdoc}
   */
  public function set(mixed $value): static {
    $validator = new Validator($this->getType());
    if ($validator->validate($value)) {
      $this->value = $value;
    }
    return $this;
  }

}
