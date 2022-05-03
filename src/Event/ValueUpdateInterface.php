<?php

declare(strict_types=1);

namespace Xylemical\Type\Event;

use Xylemical\Type\ValueInterface;

/**
 * Provides response to value being deleted in permanent storage.
 */
interface ValueUpdateInterface {

  /**
   * Performs a pre-update check.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ValueInterface $original
   *   The original value.
   *
   * @throws \Exception
   */
  public function preUpdate(ValueInterface $value, ValueInterface $original): void;

  /**
   * Responds to value being updated.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   * @param \Xylemical\Type\ValueInterface $original
   *   The original value.
   */
  public function onUpdate(ValueInterface $value, ValueInterface $original): void;

}
