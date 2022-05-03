<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Provides the base for testing attributes.
 */
class TestCase extends PhpUnitTestCase {

  use ProphecyTrait;

  /**
   * Get a mock path.
   *
   * @return \Xylemical\Type\PathInterface
   *   The path.
   */
  protected function getMockPath(): PathInterface {
    $path = $this->prophesize(PathInterface::class);
    $path->getLocation()->willReturn('test');
    return $path->reveal();
  }

}
