<?php

namespace Drupal\starwars\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Planet entity entities.
 *
 * @ingroup starwars
 */
interface PlanetEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Planet entity name.
   *
   * @return string
   *   Name of the Planet entity.
   */
  public function getName();

  /**
   * Sets the Planet entity name.
   *
   * @param string $name
   *   The Planet entity name.
   *
   * @return \Drupal\starwars\Entity\PlanetEntityInterface
   *   The called Planet entity entity.
   */
  public function setName($name);

  /**
   * Gets the Planet entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Planet entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Planet entity creation timestamp.
   *
   * @param int $timestamp
   *   The Planet entity creation timestamp.
   *
   * @return \Drupal\starwars\Entity\PlanetEntityInterface
   *   The called Planet entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Planet entity published status indicator.
   *
   * Unpublished Planet entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Planet entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Planet entity.
   *
   * @param bool $published
   *   TRUE to set this Planet entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\starwars\Entity\PlanetEntityInterface
   *   The called Planet entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Planet entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Planet entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\starwars\Entity\PlanetEntityInterface
   *   The called Planet entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Planet entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Planet entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\starwars\Entity\PlanetEntityInterface
   *   The called Planet entity entity.
   */
  public function setRevisionUserId($uid);

}
