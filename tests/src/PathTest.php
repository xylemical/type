<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
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
  protected function getMockType(string $name, ?TypeInterface $parent = NULL): TypeInterface {
    $path = $this->prophesize(PathInterface::class);
    $path->getLocation()->willReturn($name);
    if ($parent) {
      $path->getParent()->willReturn($parent);
    }

    $type = $this->prophesize(TypeInterface::class);
    $type->getName()->willReturn($name);
    $type->getPath()->willReturn($path->reveal());
    $type->isSameType(Argument::any())->willReturn(FALSE);
    $type->isSameType(Argument::any())->will(function ($args) use ($type) {
      return $type->reveal() === $args[0];
    });

    return $type->reveal();
  }

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $grandparent = $this->getMockType('grandparent');
    $parent = $this->getMockType('parent', $grandparent);
    $child = $this->getMockType('child', $parent);

    $path = new Path($grandparent);
    $this->assertEquals('grandparent', $path->getLocation());
    $this->assertSame($grandparent, $path->getType());
    $this->assertNull($path->getParent());
    $this->assertFalse($path->isParent($child));

    $path->setParent($child);
    $this->assertSame($child, $path->getParent());

    $path = new Path($child, $parent);
    $this->assertEquals('parent.child', $path->getLocation());
    $this->assertSame($child, $path->getType());
    $this->assertSame($parent, $path->getParent());
    $this->assertTrue($path->isParent($parent));
    $this->assertTrue($path->isParent($grandparent));
  }

}
