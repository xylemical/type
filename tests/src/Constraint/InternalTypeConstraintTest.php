<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\InternalTypeConstraint.
 */
class InternalTypeConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new InternalTypeConstraint();

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertTrue($constraint->isConstrained(0, $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $constraint = new InternalTypeConstraint('string');

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained(0, $context, $violations));
    $this->assertTrue($violations->hasViolations());

  }

  /**
   * Provides test data for testOptions().
   *
   * @return array[]
   *   The test data.
   */
  public function providerTestOptions(): array {
    return [
      ['bool', NULL, FALSE],
      ['bool', TRUE, TRUE],
      ['bool', 0, FALSE],
      ['bool', 0.0, FALSE],
      ['bool', '', FALSE],
      ['bool', [], FALSE],
      ['bool', (object) [], FALSE],
      ['int', NULL, FALSE],
      ['int', TRUE, FALSE],
      ['int', 0, TRUE],
      ['int', 0.0, FALSE],
      ['int', '', FALSE],
      ['int', [], FALSE],
      ['int', (object) [], FALSE],
      ['float', NULL, FALSE],
      ['float', TRUE, FALSE],
      ['float', 0, FALSE],
      ['float', 0.0, TRUE],
      ['float', '', FALSE],
      ['float', [], FALSE],
      ['float', (object) [], FALSE],
      ['array', NULL, FALSE],
      ['array', TRUE, FALSE],
      ['array', 0, FALSE],
      ['array', 0.0, FALSE],
      ['array', '', FALSE],
      ['array', [], TRUE],
      ['array', (object) [], FALSE],
      ['object', NULL, FALSE],
      ['object', TRUE, FALSE],
      ['object', 0, FALSE],
      ['object', 0.0, FALSE],
      ['object', '', FALSE],
      ['object', [], FALSE],
      ['object', (object) [], TRUE],
      ['object', new TestInternal(), TRUE],
      [TestInternal::class, NULL, FALSE],
      [TestInternal::class, TRUE, FALSE],
      [TestInternal::class, 0, FALSE],
      [TestInternal::class, 0.0, FALSE],
      [TestInternal::class, '', FALSE],
      [TestInternal::class, [], FALSE],
      [TestInternal::class, (object) [], FALSE],
      [TestInternal::class, new TestInternal(), TRUE],
    ];
  }

  /**
   * Tests the options.
   *
   * @dataProvider providerTestOptions
   */
  public function testOptions(mixed $type, mixed $value, bool $expected): void {
    $context = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();

    $context = new Path($context);
    $violations = new ViolationList();

    $constraint = new InternalTypeConstraint($type);
    $this->assertEquals(
      $expected,
      $constraint->isConstrained($value, $context, $violations)
    );
    $this->assertEquals(!$expected, $violations->hasViolations());
  }

}

/**
 * A test internal type.
 */
class TestInternal implements \Stringable {

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return '';
  }

}
