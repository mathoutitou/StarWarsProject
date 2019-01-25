<?php

namespace Drupal\starwars;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class PlanetEntityStorage extends SqlContentEntityStorage implements PlanetEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(PlanetEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {planet_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {planet_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(PlanetEntityInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {planet_entity_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('planet_entity_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
