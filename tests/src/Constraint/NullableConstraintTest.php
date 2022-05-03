<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\NullableConstraint.
 */
class NullableConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new NullableConstraint(TRUE);

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertTrue($constraint->isConstrained(NULL, $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $constraint = new NullableConstraint();

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained(NULL, $context, $violations));
    $this->assertTrue($violations->hasViolations());

  }

}
