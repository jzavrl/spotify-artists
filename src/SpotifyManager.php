<?php

namespace Drupal\cd_spotify;

use Drupal\Core\Config\ConfigManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\State\StateInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class SpotifyManager.
 */
class SpotifyManager {

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Drupal\Core\Config\ConfigManagerInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigManagerInterface
   */
  protected $configManager;

  /**
   * Drupal\Core\State\StateInterface definition.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * Drupal\Core\Logger\LoggerChannelFactoryInterface definition.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $logger;

  /**
   * Constructs a new SpotifyManager object.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The http client service.
   * @param \Drupal\Core\Config\ConfigManagerInterface $config_manager
   *   The config manager service.
   * @param \Drupal\Core\State\StateInterface $state
   *   The state manager service.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger
   *   The logger service.
   */
  public function __construct(
    ClientInterface $http_client,
    ConfigManagerInterface $config_manager,
    StateInterface $state,
    LoggerChannelFactoryInterface $logger
  ) {
    $this->httpClient = $http_client;
    $this->configManager = $config_manager;
    $this->state = $state;
    $this->logger = $logger->get('cd_spotify');
  }

  /**
   * Authenticates with the Spotify API.
   */
  public function authenticate() {
    return TRUE;
  }

  /**
   * Gets a list of artists from the API.
   *
   * @param int $limit
   *   Number of artists to retrieve.
   *
   * @return array
   *   List of artists.
   */
  public function getArtists($limit): array {
    return [];
  }

  /**
   * Gets the artist details based on the given ID.
   *
   * @param int $id
   *   The ID to load.
   *
   * @return array
   *   Artist details.
   */
  public function getArtist($id): array {
    return [];
  }

}
