<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;

/**
 * Tests \Xylemical\Type\Violation.
 */
class ViolationTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $violation = new Violation('foo.bar', 'message', ['results' => TRUE]);
    $this->assertEquals('foo.bar', $violation->getPath());
    $this->assertEquals('message', $violation->getMessage());
    $this->assertEquals(['results' => TRUE], $violation->getArguments());
  }

}
