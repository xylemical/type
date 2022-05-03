<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type.
 */
class CompareConstraintTest extends TestCase {

  /**
   * Test basic constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new CompareConstraint('test');

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained('', $context, $violations));
    $this->assertTrue($violations->hasViolations());

    $violations = new ViolationList();
    $constraint = new CompareConstraint();

    $this->assertTrue($constraint->isConstrained('', $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertTrue($violations->hasViolations());

    $violations = new ViolationList();
    $constraint = new CompareConstraint(4);
    $constraint->setOperation('>=');
    $constraint->setFilter('strlen');

    $this->assertEquals('>=', $constraint->getOperation());
    $this->assertEquals('strlen', $constraint->getFilter());

    $this->assertTrue(
      $constraint->isConstrained('testing', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse(
      $constraint->isConstrained('abc', $context, $violations)
    );
    $this->assertTrue($violations->hasViolations());
  }

  /**
   * Provides the test data for testOperations().
   *
   * @return array[]
   *   The test data.
   */
  public function providerTestOperations(): array {
    return [
      ['=', 1, 1, TRUE],
      ['=', 1, 2, FALSE],
      ['==', 1, 1, TRUE],
      ['==', 1, 2, FALSE],
      ['!=', 1, 1, FALSE],
      ['!=', 1, 2, TRUE],
      ['!', 1, 1, FALSE],
      ['!', 1, 2, TRUE],
      ['<', 1, 0, TRUE],
      ['<', 1, 1, FALSE],
      ['<', 1, 2, FALSE],
      ['<=', 1, 0, TRUE],
      ['<=', 1, 1, TRUE],
      ['<=', 1, 2, FALSE],
      ['>', 1, 0, FALSE],
      ['>', 1, 1, FALSE],
      ['>', 1, 2, TRUE],
      ['>=', 1, 0, FALSE],
      ['>=', 1, 1, TRUE],
      ['>=', 1, 2, TRUE],
    ];
  }

  /**
   * Tests operations.
   *
   * @dataProvider providerTestOperations
   */
  public function testOperations(string $operation, mixed $setting, mixed $value, bool $expected): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $context = new Path($type);
    $violations = new ViolationList();
    $constraint = new CompareConstraint($setting);
    $constraint->setOperation($operation);

    $this->assertEquals(
      $expected,
      $constraint->isConstrained($value, $context, $violations)
    );
  }

}
