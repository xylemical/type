<?php

declare(strict_types=1);

namespace Xylemical\Type\Storage;

use Xylemical\Type\TypeInterface;
use Xylemical\Type\ValueInterface;

/**
 * Allows the type values to be stored.
 */
interface StoredTypeInterface extends TypeInterface {

  /**
   * Get the identifier used by the type for storage.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   *
   * @return string
   *   The identifier.
   */
  public function getId(ValueInterface $value): string;

  /**
   * Set the identifier for the value.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param string $identifier
   *   The identifier.
   *
   * @return $this
   */
  public function setId(ValueInterface $value, string $identifier): static;

  /**
   * Get the storage mechanism used for the type.
   *
   * @return \Xylemical\Type\Storage\StorageInterface|null
   *   The storage.
   */
  public function getStorage(): ?StorageInterface;

  /**
   * Set the storage mechanism used for values of type.
   *
   * @param \Xylemical\Type\Storage\StorageInterface|null $storage
   *   The storage.
   *
   * @return $this
   */
  public function setStorage(?StorageInterface $storage): static;

}
