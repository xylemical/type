<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Xylemical\Type\Constraint\NullableConstraint;

/**
 * Tests \Xylemical\Type\Value.
 */
class ValueTest extends TestCase {

  use ProphecyTrait;

  /**
   * Create a mock type.
   *
   * @param \Xylemical\Type\ConstraintInterface|null $constraint
   *   The constraint.
   *
   * @return \Xylemical\Type\TypeInterface
   *   The type.
   */
  protected function getMockType(?ConstraintInterface $constraint): TypeInterface {
    $path = $this->prophesize(PathInterface::class);
    $path->getLocation()->willReturn('test');

    $type = $this->prophesize(TypeInterface::class);
    $type->getPath()->willReturn($path->reveal());
    if ($constraint) {
      $type->getConstraints()->willReturn([$constraint]);
    }
    else {
      $type->getConstraints()->willReturn([]);
    }
    return $type->reveal();
  }

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $type = $this->getMockType(NULL);
    $value = new Value($type, NULL);
    $this->assertSame($type, $value->getType());
    $this->assertNull($value->get());

    $value = new Value($type, 'test');
    $this->assertEquals('test', $value->get());

    $value->set('foo');
    $this->assertEquals('foo', $value->get());
  }

  /**
   * Tests an invalid initial value.
   */
  public function testInvalidInitial(): void {
    $this->expectException(\InvalidArgumentException::class);

    $type = $this->getMockType(new NullableConstraint(FALSE));
    new Value($type, NULL);
  }

  /**
   * Tests an invalid set.
   */
  public function testInvalidSet(): void {
    $type = $this->getMockType(new NullableConstraint(FALSE));
    $value = new Value($type, 'foo');

    $value->set(NULL);
    $this->assertEquals('foo', $value->get());
  }

}
