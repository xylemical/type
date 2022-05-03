<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Tests \Xylemical\Type\Path.
 */
class PathTest extends TestCase {

  use ProphecyTrait;

  /**
   * Create a mock type.
   *
   * @return \Xylemical\Type\TypeInterface
   *   The type.
   */
  protected function getMockType(string $name): TypeInterface {
    $path = $this->prophesize(PathInterface::class);
    $path->getLocation()->willReturn($name);

    $type = $this->prophesize(TypeInterface::class);
    $type->getName()->willReturn($name);
    $type->getPath()->willReturn($path->reveal());

    return $type->reveal();
  }

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $parent = $this->getMockType('parent');
    $child = $this->getMockType('child');

    $path = new Path($parent);
    $this->assertEquals('parent', $path->getLocation());
    $this->assertSame($parent, $path->getType());
    $this->assertNull($path->getParent());

    $path->setParent($child);
    $this->assertSame($child, $path->getParent());

    $path = new Path($child, $parent);
    $this->assertEquals('parent.child', $path->getLocation());
    $this->assertSame($child, $path->getType());
    $this->assertSame($parent, $path->getParent());
  }

}
