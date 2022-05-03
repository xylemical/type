<?php

declare(strict_types=1);

namespace Xylemical\Type\Storage;

use Xylemical\Type\TypeInterface;
use Xylemical\Type\ValueInterface;

/**
 * Provides for values to be stored.
 */
interface StoredValueInterface extends ValueInterface {

  /**
   * {@inheritdoc}
   *
   * @return \Xylemical\Type\Storage\StoredTypeInterface
   *   The stored type.
   */
  public function getType(): TypeInterface;

  /**
   * Get the storage.
   *
   * @return \Xylemical\Type\Storage\StorageInterface|null
   *   The storage.
   */
  public function getStorage(): ?StorageInterface;

  /**
   * Set the storage.
   *
   * @param \Xylemical\Type\Storage\StorageInterface|null $storage
   *   The storage.
   *
   * @return $this
   */
  public function setStorage(?StorageInterface $storage): static;

  /**
   * Reset the value to its defaults or original state.
   *
   * @return $this
   */
  public function reset(): static;

  /**
   * Save the value.
   *
   * @return $this
   */
  public function save(): static;

  /**
   * Delete the value.
   *
   * @return $this
   */
  public function delete(): static;

}
