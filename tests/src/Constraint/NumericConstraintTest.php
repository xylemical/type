<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\NumericConstraint.
 */
class NumericConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new NumericConstraint();

    $this->assertTrue(
      $constraint->isConstrained(0, $context, $violations)
    );
    $this->assertTrue(
      $constraint->isConstrained(0.0, $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained('', $context, $violations));
    $this->assertTrue($violations->hasViolations());

    $violations = new ViolationList();
    $this->assertFalse(
      $constraint->isConstrained('0.1', $context, $violations)
    );
    $this->assertTrue($violations->hasViolations());
  }

}
