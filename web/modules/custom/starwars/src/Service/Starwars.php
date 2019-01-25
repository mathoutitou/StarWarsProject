<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 25/01/19
 * Time: 11:42
 */

namespace Drupal\starwars\Service;


class Starwars implements StarwarsInterface {

  protected $httpClient;

  public function __construct() {
    $this->httpClient = \Drupal::httpClient();
  }

  /**
   * Add a StarWars Character
   *
   * @param integer $id The StarWars People Id
   *
   * @return mixed
   */
  public function addPeople($id) {

    // Requête sur l'API
    // On récupère le personnage au format json
    $request = $this->httpClient->get('https://swapi.co/api/people/' . $id);
    $people = json_decode($request->getBody());

    // On vérifie que le personnage n'existe pas déjà
    $ids = \Drupal::entityQuery('starwars_people')
      ->condition('name', $people->name)
      ->execute();

    // Le personnage n'existe pas alors:
    if (empty($ids)) {
      /**
       * Création/Récupération des entités associées :
       * Planète
       * Starship
       */

      $planet = $this->addPlanet($people->homeworld);
      $specie = $this->getSpecies($people->species[0]);

      $peopleStarship = [];
      // On parcours la liste des vaisseaux
    }


  }

  /**
   * Add a StarWars Planet
   *
   * @param string $uri The Swapi URI
   *
   * @return string $id An Entity Planet Id
   */
  public function addPlanet($uri) {
    /**
     * Requête sur l'API
     * On récupère le vaisseau au format json
     */
    $request = $this->httpClient->get($uri);
    $starship = json_decode($request->getBody());

    /**
     * On vérifie que le vaisseau n'existe pas déjà
     * Si c'est le cas on récupère l'identifiant pour l'ajouter au personnage
     */
    $result = \Drupal::entityQuery('starwars_starship')
      ->condition('name', $starship->name)
      ->execute();

    // Le vaisseau n'existe pas
    if (empty($result)) {

      // Création de l'entité Starship
      $newStarship = $starship::create([
        'name' => $starship->name,
        'field_model' => $starship->model,
      ]);

      $newStarship->save();

      drupal_set_message('Le vaisseau' . $starship->name . ' a été ajouté');

      return $newStarship->id(); // Renvoie l'identifiant du vaisseau ajouté
    }
    else {
      return current($result); // Renvoie l'identifiant du vaisseau déjà existant
    }
  }
  }

  /**
   * Get a Species name from the Swapi URI
   *
   * @param string $uri The Swapi URI
   *
   * @return string The species name
   */
  public function getSpecies($uri) {
  /**
   * Requête sur l'API
   * On récupère le vaisseau au format json
   */
  $request = $this->httpClient->get($uri);
  $starship = json_decode($request->getBody());

  /**
   * On vérifie que le vaisseau n'existe pas déjà
   * Si c'est le cas on récupère l'identifiant pour l'ajouter au personnage
   */
  $result = \Drupal::entityQuery('starwars_starship')
    ->condition('name', $starship->name)
    ->execute();

  // Le vaisseau n'existe pas
  if (empty($result)) {

    // Création de l'entité Starship
    $newStarship = $starship::create([
      'name' => $starship->name,
      'field_model' => $starship->model,
    ]);

    $newStarship->save();

    drupal_set_message('Le vaisseau' . $starship->name . ' a été ajouté');

    return $newStarship->id(); // Renvoie l'identifiant du vaisseau ajouté
  }
  else {
    return current($result); // Renvoie l'identifiant du vaisseau déjà existant
  }
}
  }

  /**
   * Add a StarWars StarShip
   *
   * @param string $uri The Swapi URI
   *
   * @return string $id An Entity Starship Id
   */
  public function addStarship($uri) {

    /**
     * Requête sur l'API
     * On récupère le vaisseau au format json
     */
    $request = $this->httpClient->get($uri);
    $starship = json_decode($request->getBody());

    /**
     * On vérifie que le vaisseau n'existe pas déjà
     * Si c'est le cas on récupère l'identifiant pour l'ajouter au personnage
     */
    $result = \Drupal::entityQuery('starwars_starship')
      ->condition('name', $starship->name)
      ->execute();

    // Le vaisseau n'existe pas
    if (empty($result)) {

      // Création de l'entité Starship
      $newStarship = $starship::create([
        'name' => $starship->name,
        'field_model' => $starship->model,
      ]);

      $newStarship->save();

      drupal_set_message('Le vaisseau' . $starship->name . ' a été ajouté');

      return $newStarship->id(); // Renvoie l'identifiant du vaisseau ajouté
    }
    else {
      return current($result); // Renvoie l'identifiant du vaisseau déjà existant
    }
  }
}
