<?php

namespace Drupal\starwars\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Starship entity entities.
 *
 * @ingroup starwars
 */
interface StarshipEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Starship entity name.
   *
   * @return string
   *   Name of the Starship entity.
   */
  public function getName();

  /**
   * Sets the Starship entity name.
   *
   * @param string $name
   *   The Starship entity name.
   *
   * @return \Drupal\starwars\Entity\StarshipEntityInterface
   *   The called Starship entity entity.
   */
  public function setName($name);

  /**
   * Gets the Starship entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Starship entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Starship entity creation timestamp.
   *
   * @param int $timestamp
   *   The Starship entity creation timestamp.
   *
   * @return \Drupal\starwars\Entity\StarshipEntityInterface
   *   The called Starship entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Starship entity published status indicator.
   *
   * Unpublished Starship entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Starship entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Starship entity.
   *
   * @param bool $published
   *   TRUE to set this Starship entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\starwars\Entity\StarshipEntityInterface
   *   The called Starship entity entity.
   */
  public function setPublished($published);

}
