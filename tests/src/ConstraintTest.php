<?php

declare(strict_types=1);

namespace Xylemical\Type;

use Xylemical\Type\Constraint\NullableConstraint;
use Xylemical\Type\Constraint\PatternConstraint;
use Xylemical\Type\Constraint\RequiredConstraint;

/**
 * Tests \Xylemical\Type\Constraint.
 */
class ConstraintTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $violations = new ViolationList();
    $path = $this->getMockPath();
    $constraint = new Constraint(FALSE);
    $this->assertEquals([], $constraint->getConstraints());
    $this->assertFalse($constraint->applies(NULL));
    $this->assertFalse($constraint->applies('test'));
    $this->assertFalse($constraint->isConstrained(NULL, $path, $violations));

    $c1 = new NullableConstraint(FALSE);
    $c2 = new RequiredConstraint(TRUE);
    $constraint->setConstraints([$c1]);
    $this->assertEquals([$c1], $constraint->getConstraints());
    $this->assertTrue($constraint->applies(NULL));
    $this->assertTrue($constraint->applies('test'));

    $this->assertFalse($constraint->isConstrained('test', $path, $violations));
    $this->assertTrue($constraint->isConstrained(NULL, $path, $violations));
    $this->assertEquals(1, count($violations));

    $constraint->addConstraint($c2);
    $this->assertEquals([$c1, $c2], $constraint->getConstraints());

    $violations = new ViolationList();
    $this->assertFalse($constraint->isConstrained('test', $path, $violations));
    $this->assertTrue($constraint->isConstrained(NULL, $path, $violations));
    $this->assertEquals(1, count($violations));

    $violations = new ViolationList();
    $constraint = new Constraint(TRUE);
    $constraint->addConstraints([$c1, $c2]);
    $this->assertFalse($constraint->isConstrained('test', $path, $violations));
    $this->assertTrue($constraint->isConstrained(NULL, $path, $violations));
    $this->assertEquals(2, count($violations));
  }

  /**
   * Tests a constraint doesn't apply when it shouldn't.
   */
  public function testConstraintNotApplying(): void {
    $violations = new ViolationList();
    $path = $this->getMockPath();
    $constraint = new Constraint(TRUE);
    $constraint->addConstraint(new PatternConstraint('/^test$/'));

    $this->assertFalse($constraint->isConstrained(10, $path, $violations));
    $this->assertFalse($constraint->isConstrained('test', $path, $violations));
    $this->assertTrue($constraint->isConstrained('test1', $path, $violations));
  }

}
