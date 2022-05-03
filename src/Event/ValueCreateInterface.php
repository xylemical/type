<?php

declare(strict_types=1);

namespace Xylemical\Type\Event;

use Xylemical\Type\ValueInterface;

/**
 * Provides response to value being created in permanent storage.
 */
interface ValueCreateInterface {

  /**
   * Performs a pre-creation check.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   *
   * @throws \Exception
   */
  public function preCreate(ValueInterface $value): void;

  /**
   * Responds to value being created.
   *
   * @param \Xylemical\Type\ValueInterface $value
   *   The value.
   */
  public function onCreate(ValueInterface $value): void;

}
