<?php

namespace Drupal\starwars\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining People entity entities.
 *
 * @ingroup starwars
 */
interface PeopleEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the People entity name.
   *
   * @return string
   *   Name of the People entity.
   */
  public function getName();

  /**
   * Sets the People entity name.
   *
   * @param string $name
   *   The People entity name.
   *
   * @return \Drupal\starwars\Entity\PeopleEntityInterface
   *   The called People entity entity.
   */
  public function setName($name);

  /**
   * Gets the People entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the People entity.
   */
  public function getCreatedTime();

  /**
   * Sets the People entity creation timestamp.
   *
   * @param int $timestamp
   *   The People entity creation timestamp.
   *
   * @return \Drupal\starwars\Entity\PeopleEntityInterface
   *   The called People entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the People entity published status indicator.
   *
   * Unpublished People entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the People entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a People entity.
   *
   * @param bool $published
   *   TRUE to set this People entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\starwars\Entity\PeopleEntityInterface
   *   The called People entity entity.
   */
  public function setPublished($published);

}
