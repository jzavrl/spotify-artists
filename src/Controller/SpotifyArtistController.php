<?php

namespace Drupal\cd_spotify\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SpotifyArtistController.
 */
class SpotifyArtistController extends ControllerBase {

  /**
   * Drupal\cd_spotify\SpotifyManager definition.
   *
   * @var \Drupal\cd_spotify\SpotifyManager
   */
  protected $spotifyManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->spotifyManager = $container->get('cd_spotify.spotify_manager');
    return $instance;
  }

  /**
   * Title callback.
   *
   * @param string $artist
   *   The artist ID from the route.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  public function getTitle($artist): TranslatableMarkup {
    return $this->t('Showing details on @artist.', ['@artist' => $this->loadArtist($artist)]);
  }

  /**
   * Controller callback for the artist detail page.
   *
   * @param string $artist
   *   The artist ID from the route.
   *
   * @return array
   *   Renderable array.
   */
  public function showArtist($artist): array {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Showing details on @artist.', ['@artist' => $this->loadArtist($artist)]),
    ];
  }

  /**
   * Helper method to load the artist from the API.
   *
   * We could also use the ParamConverterManager to load the parameter there and
   * have it ready for the build and title callbacks so we would not need to
   * call this method everytime.
   *
   * @param string $artist
   *   The artist ID from the route.
   */
  private function loadArtist($artist) {
    return $artist;
  }

}
