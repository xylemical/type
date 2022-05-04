<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;
use Xylemical\Type\Type\BooleanType;

/**
 * Tests \Xylemical\Type\Type.
 */
class TypeTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $constraintFactory = new ConstraintFactory();
    $attributeFactory = new AttributeFactory($constraintFactory);
    $type = $this->getMockForAbstractClass(Type::class, [$attributeFactory]);
    $this->assertFalse($type->getAttribute('required')->getValue());
    $this->assertFalse($type->hasAttribute('foo'));
    $this->assertNull($type->getAttribute('foo'));
    $this->assertEquals('', $type->getName());
    $this->assertEquals('', $type->getPath()->getLocation());
    $this->assertNull($type->getPath()->getParent());
    $this->assertSame($type, $type->getPath()->getType());
    $this->assertEquals(2, count($type->getAttributes()));
    $this->assertEquals(2, count($type->getConstraints()));
    $this->assertTrue($type->isSameType($type));

    $type->setName('fred');
    $this->assertEquals('fred', $type->getName());

    $type = $this->getMockForAbstractClass(Type::class, [
      $attributeFactory,
      ['required' => TRUE],
    ]);
    $this->assertTrue($type->getAttribute('required')->getValue());

    $other = $this->getMockBuilder(Type::class)
      ->disableOriginalConstructor()
      ->getMock();
    $this->assertFalse($type->isSameType($other));

    $other = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $this->assertFalse($type->isSameType($other));
  }

}
