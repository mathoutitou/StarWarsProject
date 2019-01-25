<?php

namespace Drupal\starwars\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Planet entity entities.
 */
class PlanetEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
