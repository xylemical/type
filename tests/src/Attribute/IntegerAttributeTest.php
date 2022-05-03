<?php

declare(strict_types=1);

namespace Xylemical\Type\Attribute;

use Xylemical\Type\Constraint;
use Xylemical\Type\ConstraintFactory;
use Xylemical\Type\TestCase;
use Xylemical\Type\ViolationList;

/**
 * Tests \Xylemical\Type\IntegerAttribute.
 */
class IntegerAttributeTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $factory = new ConstraintFactory();
    $attribute = new IntegerAttribute('test', TRUE, $factory);

    $violations = new ViolationList();
    $path = $this->getMockPath();

    $constraint = new Constraint(TRUE);
    $constraint->addConstraints($attribute->getConstraints());
    $this->assertTrue($constraint->isConstrained(TRUE, $path, $violations));
    $this->assertTrue($constraint->isConstrained(FALSE, $path, $violations));
    $this->assertTrue($constraint->isConstrained(NULL, $path, $violations));
    $this->assertTrue($constraint->isConstrained('test', $path, $violations));
    $this->assertTrue($constraint->isConstrained('1', $path, $violations));
    $this->assertFalse($constraint->isConstrained(1, $path, $violations));
    $this->assertTrue($constraint->isConstrained(1.0, $path, $violations));
    $this->assertTrue($constraint->isConstrained([], $path, $violations));
    $this->assertTrue($constraint->isConstrained((object) [], $path, $violations));
  }

}
