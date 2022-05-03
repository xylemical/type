<?php

declare(strict_types=1);

namespace Xylemical\Type;

use PHPUnit\Framework\TestCase;

/**
 * Tests \Xylemical\Type\ValueFactory.
 */
class ValueFactoryTest extends TestCase {

  /**
   * Tests sanity.
   */
  public function testSanity(): void {
    $type = $this->getMockBuilder(TypeInterface::class)
      ->disableOriginalConstructor()
      ->getMock();
    $factory = new ValueFactory();
    $value = $factory->create($type, 'foo');
    $this->assertSame($type, $value->getType());
    $this->assertEquals('foo', $value->get());
  }

}
