<?php

declare(strict_types=1);

namespace Xylemical\Type\Event;

use Xylemical\Type\ValueInterface;

/**
 * Provides response to value being deleted in permanent storage.
 */
interface ValueDeleteInterface {

  /**
   * Performs a pre-deletion check.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   *
   * @throws \Exception
   */
  public function preDelete(ValueInterface $value): void;

  /**
   * Responds to value being deleted.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  public function onDelete(ValueInterface $value): void;

}
