<?php

declare(strict_types=1);

namespace Xylemical\Type\Event;

use Xylemical\Type\ValueInterface;

/**
 * Provides response to value being loaded from permanent storage.
 */
interface ValueLoadInterface {

  /**
   * Responds to value being loaded.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  public function onLoad(ValueInterface $value): void;

}
