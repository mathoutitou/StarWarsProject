<?php

/**
 * @file
 * Contains planet_entity.page.inc.
 *
 * Page callback for Planet entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Planet entity templates.
 *
 * Default template: planet_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_planet_entity(array &$variables) {
  // Fetch PlanetEntity Entity Object.
  $planet_entity = $variables['elements']['#planet_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
