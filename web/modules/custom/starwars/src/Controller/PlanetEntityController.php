<?php

namespace Drupal\starwars\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\starwars\Entity\PlanetEntityInterface;

/**
 * Class PlanetEntityController.
 *
 *  Returns responses for Planet entity routes.
 */
class PlanetEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Planet entity  revision.
   *
   * @param int $planet_entity_revision
   *   The Planet entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($planet_entity_revision) {
    $planet_entity = $this->entityManager()->getStorage('planet_entity')->loadRevision($planet_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('planet_entity');

    return $view_builder->view($planet_entity);
  }

  /**
   * Page title callback for a Planet entity  revision.
   *
   * @param int $planet_entity_revision
   *   The Planet entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($planet_entity_revision) {
    $planet_entity = $this->entityManager()->getStorage('planet_entity')->loadRevision($planet_entity_revision);
    return $this->t('Revision of %title from %date', ['%title' => $planet_entity->label(), '%date' => format_date($planet_entity->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Planet entity .
   *
   * @param \Drupal\starwars\Entity\PlanetEntityInterface $planet_entity
   *   A Planet entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(PlanetEntityInterface $planet_entity) {
    $account = $this->currentUser();
    $langcode = $planet_entity->language()->getId();
    $langname = $planet_entity->language()->getName();
    $languages = $planet_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $planet_entity_storage = $this->entityManager()->getStorage('planet_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $planet_entity->label()]) : $this->t('Revisions for %title', ['%title' => $planet_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all planet entity revisions") || $account->hasPermission('administer planet entity entities')));
    $delete_permission = (($account->hasPermission("delete all planet entity revisions") || $account->hasPermission('administer planet entity entities')));

    $rows = [];

    $vids = $planet_entity_storage->revisionIds($planet_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\starwars\PlanetEntityInterface $revision */
      $revision = $planet_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $planet_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.planet_entity.revision', ['planet_entity' => $planet_entity->id(), 'planet_entity_revision' => $vid]));
        }
        else {
          $link = $planet_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.planet_entity.translation_revert', ['planet_entity' => $planet_entity->id(), 'planet_entity_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.planet_entity.revision_revert', ['planet_entity' => $planet_entity->id(), 'planet_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.planet_entity.revision_delete', ['planet_entity' => $planet_entity->id(), 'planet_entity_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['planet_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
