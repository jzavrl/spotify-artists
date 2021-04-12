<?php

namespace Drupal\cd_spotify\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'SpotifyArtistsBlock' block.
 *
 * @Block(
 *  id = "spotify_artists_block",
 *  admin_label = @Translation("Spotify Artists"),
 * )
 */
class SpotifyArtistsBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\cd_spotify\SpotifyManager definition.
   *
   * @var \Drupal\cd_spotify\SpotifyManager
   */
  protected $spotifyManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->spotifyManager = $container->get('cd_spotify.spotify_manager');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['number'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of artists'),
      '#description' => $this->t('Number of artists this block should show.'),
      '#default_value' => $this->configuration['number'],
      '#min' => 1,
      '#max' => 20,
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['number'] = $form_state->getValue('number');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $limit = $this->configuration['number'];
    $artists = $this->spotifyManager->getArtists($limit);

    // Return a list of artists. Could also use hook_theme to provide a custom
    // theme template and use that to render if special markup is needed.
    // Depending on what the API returns we would have to loop through the array
    // here and build links with the Url:fromRoute method to use our custom
    // route for the artist detail page. Caching is left as default, but we can
    // override it with the tags/maxage/context methods from the block.
    return [
      '#theme' => 'item_list',
      '#items' => [
        $artists,
      ],
    ];
  }



}
