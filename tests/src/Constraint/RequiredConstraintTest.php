<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\RequiredConstraint.
 */
class RequiredConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new RequiredConstraint();

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertTrue($constraint->isConstrained('', $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $constraint = new RequiredConstraint(TRUE);

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained('', $context, $violations));
    $this->assertTrue($violations->hasViolations());
  }

}
