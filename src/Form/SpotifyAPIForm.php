<?php

namespace Drupal\cd_spotify\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SpotifyAPIForm.
 */
class SpotifyAPIForm extends ConfigFormBase {

  /**
   * Spotify API URL.
   *
   * @var string
   */
  const SPOTIFY_API_URL = 'https://api.spotify.com';

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
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->configManager = $container->get('config.manager');
    $instance->state = $container->get('state');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'cd_spotify.spotify_api',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'spotify_api_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('cd_spotify.spotify_api');

    $form['endpoint_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Endpoint URL'),
      '#description' => $this->t('Enter the Spotify API endpoint URL.'),
      '#default_value' => $config->get('endpoint_url') ?: self::SPOTIFY_API_URL,
      '#required' => TRUE,
    ];
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('Username for the API authentication.'),
      '#default_value' => $config->get('username'),
      '#required' => TRUE,
    ];
    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#description' => $this->t('API authentication password.'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('cd_spotify.spotify_api')
      ->set('endpoint_url', $form_state->getValue('endpoint_url'))
      ->set('username', $form_state->getValue('username'))
      ->save();

    if (!empty($form_state->getValue('password'))) {
      $this->state->set('cd_spotify.password', $form_state->getValue('password'));
    }
  }

}
