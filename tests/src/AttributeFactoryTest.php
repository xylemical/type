<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\Attribute\RequiredAttribute;

/**
 * Tests \Xylemical\Type\AttributeFactory.
 */
class AttributeFactoryTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $constraintFactory = $this->getMockBuilder(ConstraintFactoryInterface::class)->getMock();
    $factory = new AttributeFactory($constraintFactory);
    $this->assertSame($constraintFactory, $factory->getConstraintFactory());

    $newFactory = $this->getMockBuilder(ConstraintFactoryInterface::class)->getMock();
    $factory->setConstraintFactory($newFactory);
    $this->assertSame($newFactory, $factory->getConstraintFactory());

    $attribute = $factory->create(RequiredAttribute::class, 'test', TRUE);
    $this->assertInstanceOf(RequiredAttribute::class, $attribute);
    $this->assertEquals('test', $attribute->getname());
    $this->assertEquals(TRUE, $attribute->getValue());
    $this->assertSame($newFactory, $attribute->getConstraintFactory());
  }

}
