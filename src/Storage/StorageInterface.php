<?php

declare(strict_types=1);

namespace Xylemical\Type\Storage;

use Xylemical\Type\ViolationListInterface;

/**
 * Provides generic storage interface for a type.
 */
interface StorageInterface {

  /**
   * Check the storage applies to the type.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   *
   * @return bool
   *   The result.
   */
  public function applies(StoredTypeInterface $type): bool;

  /**
   * Check a value for type with identifier exists.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param string $id
   *   The identifier.
   *
   * @return bool
   *   The result.
   */
  public function exists(StoredTypeInterface $type, string $id): bool;

  /**
   * Load the value for the type.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param string $id
   *   The identifier.
   *
   * @return \Xylemical\Type\Storage\StoredValueInterface|null
   *   The value.
   */
  public function load(StoredTypeInterface $type, string $id): ?StoredValueInterface;

  /**
   * Create a value from a type.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param array $values
   *   The values.
   *
   * @return \Xylemical\Type\Storage\StoredValueInterface|null
   *   The value.
   */
  public function create(StoredTypeInterface $type, array $values = []): ?StoredValueInterface;

  /**
   * Save the value.
   *
   * @param \Xylemical\Type\Storage\StoredValueInterface $value
   *   The value.
   *
   * @return \Xylemical\Type\ViolationListInterface
   *   Any violations that prohibit saving the value.
   */
  public function save(StoredValueInterface $value): ViolationListInterface;

  /**
   * Delete the value.
   *
   * @param \Xylemical\Type\Storage\StoredTypeInterface $type
   *   The type.
   * @param string $id
   *   The identifier.
   *
   * @return \Xylemical\Type\ViolationListInterface
   *   Any violations that prohibit deleting the value.
   */
  public function delete(StoredTypeInterface $type, string $id): ViolationListInterface;

}
