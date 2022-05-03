<?php

namespace Xylemical\Type\Constraint;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\TypeInterface;
use Xylemical\Type\ViolationList;
use Xylemical\Type\Path;

/**
 * Tests \Xylemical\Type\Constraint\PatternConstraint.
 */
class PatternConstraintTest extends TestCase {

  /**
   * Tests constraint.
   */
  public function testConstraint(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $context = new Path($type);
    $violations = new ViolationList();

    $constraint = new PatternConstraint();

    $this->assertFalse($constraint->applies(1));
    $this->assertTrue($constraint->applies('test'));
    $this->assertTrue($constraint->applies(new TestPattern()));

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertTrue($constraint->isConstrained('', $context, $violations));
    $this->assertFalse($violations->hasViolations());

    $constraint = new PatternConstraint('/^test$/');

    $this->assertTrue(
      $constraint->isConstrained('test', $context, $violations)
    );
    $this->assertFalse($violations->hasViolations());

    $this->assertFalse($constraint->isConstrained('', $context, $violations));
    $this->assertTrue($violations->hasViolations());

  }

}

/**
 * A test pattern class.
 */
class TestPattern implements \Stringable {

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return '';
  }

}
