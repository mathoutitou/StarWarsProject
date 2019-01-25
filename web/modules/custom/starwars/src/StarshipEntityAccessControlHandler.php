<?php

namespace Drupal\starwars;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Starship entity entity.
 *
 * @see \Drupal\starwars\Entity\StarshipEntity.
 */
class StarshipEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\starwars\Entity\StarshipEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished starship entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published starship entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit starship entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete starship entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add starship entity entities');
  }

}
