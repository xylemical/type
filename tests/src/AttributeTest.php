<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;

/**
 * Tests \Xylemical\Type\Attribute.
 */
class AttributeTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $constraintFactory = new ConstraintFactory();
    $attribute = new Attribute('foo', 'bar', $constraintFactory);
    $this->assertEquals('foo', $attribute->getName());
    $this->assertEquals('bar', $attribute->getValue());
    $this->assertSame($constraintFactory, $attribute->getConstraintFactory());
    $this->assertEquals([], $attribute->getConstraints());
    $this->assertEquals([], $attribute->getValueConstraints());

    $attribute->setValue('faz');
    $this->assertEquals('faz', $attribute->getValue());
  }

}
