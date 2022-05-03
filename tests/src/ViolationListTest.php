<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Tests \Xylemical\Type\ViolationList.
 */
class ViolationListTest extends TestCase {

  use ProphecyTrait;

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $violations = new ViolationList();
    $this->assertEquals([], $violations->getViolations());
    $this->assertFalse($violations->hasViolations());

    $path = $this->prophesize(PathInterface::class);
    $path->getLocation()->willReturn('test');
    $path = $path->reveal();

    $violations->addViolation($path, 'test message', ['test' => TRUE]);
    $this->assertTrue($violations->hasViolations());

    $contents = $violations->getViolations();
    $this->assertEquals('test', $contents[0]->getPath());
    $this->assertEquals('test message', $contents[0]->getMessage());
    $this->assertEquals(['test' => TRUE], $contents[0]->getArguments());

    foreach ($violations as $violation) {
      $this->assertEquals('test', $violation->getPath());
      $this->assertEquals('test message', $violation->getMessage());
      $this->assertEquals(['test' => TRUE], $violation->getArguments());
    }
  }

}
