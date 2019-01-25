<?php

namespace Drupal\starwars;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\starwars\Entity\PlanetEntityInterface;

/**
 * Defines the storage handler class for Planet entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * Planet entity entities.
 *
 * @ingroup starwars
 */
interface PlanetEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Planet entity revision IDs for a specific Planet entity.
   *
   * @param \Drupal\starwars\Entity\PlanetEntityInterface $entity
   *   The Planet entity entity.
   *
   * @return int[]
   *   Planet entity revision IDs (in ascending order).
   */
  public function revisionIds(PlanetEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Planet entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Planet entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\starwars\Entity\PlanetEntityInterface $entity
   *   The Planet entity entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(PlanetEntityInterface $entity);

  /**
   * Unsets the language for all Planet entity with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
