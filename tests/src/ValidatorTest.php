<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Xylemical\Type\Constraint\NullableConstraint;

/**
 * Tests \Xylemical\Type\Validator.
 */
class ValidatorTest extends TestCase {

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
    $validator = new Validator($type);
    $this->assertFalse($validator->hasViolations());
    $this->assertEquals([], $validator->getViolations()->getViolations());

    $this->assertTrue($validator->validate(NULL));
    $this->assertFalse($validator->hasViolations());
    $this->assertEquals([], $validator->getViolations()->getViolations());

    $this->assertTrue($validator->validate(''));
    $this->assertTrue($validator->validate('test'));

    $type = $this->getMockType(new NullableConstraint(TRUE));
    $validator = new Validator($type);
    $this->assertTrue($validator->validate(NULL));
    $this->assertTrue($validator->validate(''));
    $this->assertTrue($validator->validate('test'));

    $type = $this->getMockType(new NullableConstraint(FALSE));
    $validator = new Validator($type);
    $this->assertFalse($validator->validate(NULL));
    $this->assertTrue($validator->hasViolations());
    $violations = $validator->getViolations();
    $this->assertEquals(1, count($violations));

    $this->assertTrue($validator->validate(''));
    $this->assertTrue($validator->validate('test'));
  }

}
