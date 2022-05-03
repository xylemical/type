<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\MultipleConstraint.
 */
class MultipleConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new MultipleConstraint();

    $this->assertTrue($constraint->applies(1));
    $this->assertTrue($constraint->applies(1.0));
    $this->assertFalse($constraint->applies('test'));
    $this->assertFalse($constraint->applies(new TestPattern()));

    $this->assertTrue(
      $constraint->isConstrained(2, $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertTrue($constraint->isConstrained(3, $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $constraint = new MultipleConstraint(2);

    $this->assertTrue(
      $constraint->isConstrained(2, $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained(3, $context, $violations));
    $this->assertTrue($violations->hasViolations());

    $constraint->setMargin(0.01);
    $this->assertEquals(0.01, $constraint->getMargin());
  }

  /**
   * Provides test data for testOptions.
   *
   * @return array[]
   *   The test data.
   */
  public function providerTestOptions(): array {
    return [
      [1, 2, TRUE],
      [1, 3, TRUE],
      [1, 2.0, TRUE],
      [1, 3.0, TRUE],
      [2, 2, TRUE],
      [2, 3, FALSE],
      [2, 2.0, TRUE],
      [2, 3.0, FALSE],
      [0.1, 2, TRUE],
      [0.1, 3, TRUE],
      [0.1, 2.05, FALSE],
      [0.1, 2.1, TRUE],
      [0.1, 3.0, TRUE],
      [0.1, 3.05, FALSE],
    ];
  }

  /**
   * Test the options.
   *
   * @dataProvider providerTestOptions
   */
  public function testOptions(mixed $setting, mixed $value, bool $expected): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new MultipleConstraint($setting);
    $this->assertEquals(
      $expected,
      $constraint->isConstrained($value, $context, $violations)
    );
    $this->assertEquals(!$expected, $violations->hasViolations());
  }

}
