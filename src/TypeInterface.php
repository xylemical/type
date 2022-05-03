<?php

declare(strict_types=1);

namespace Xylemical\Type;

/**
 * Provides the type definition.
 */
interface TypeInterface {

  /**
   * TypeInterface constructor.
   *
   * @param \Xylemical\Type\AttributeFactoryInterface $attributeFactory
   *   The attribute settings.
   * @param array $settings
   *   The attribute factory.
   */
  public function __construct(AttributeFactoryInterface $attributeFactory, array $settings = []);

  /**
   * Get the type path within a complex type.
   *
   * @return \Xylemical\Type\PathInterface
   *   The type path.
   */
  public function getPath(): PathInterface;

  /**
   * Get the name of the type.
   *
   * @return string
   *   The name.
   */
  public function getName(): string;

  /**
   * Set the name of the type.
   *
   * @param string $name
   *   The name.
   *
   * @return $this
   */
  public function setName(string $name): static;

  /**
   * Get the attributes of the type.
   *
   * @return \Xylemical\Type\AttributeInterface[]
   *   The attributes.
   */
  public function getAttributes(): array;

  /**
   * Get an attribute.
   *
   * @param string $name
   *   The name.
   *
   * @return \Xylemical\Type\AttributeInterface|null
   *   The attribute or NULL.
   */
  public function getAttribute(string $name): ?AttributeInterface;

  /**
   * Check the type has an attribute.
   *
   * @param string $name
   *   The attribute.
   *
   * @return bool
   *   The result.
   */
  public function hasAttribute(string $name): bool;

  /**
   * Set multiple attribute values.
   *
   * @param array $attributes
   *   The attributes indexed by name.
   *
   * @return $this
   */
  public function setAttributes(array $attributes): static;

  /**
   * Set the attribute value for the type.
   *
   * @param string $name
   *   The attribute.
   * @param mixed $value
   *   The values.
   *
   * @return $this
   */
  public function setAttribute(string $name, mixed $value): static;

  /**
   * Get the constraints for the type value.
   *
   * @return \Xylemical\Type\ConstraintInterface[]
   *   The constraints.
   */
  public function getConstraints(): array;

}
