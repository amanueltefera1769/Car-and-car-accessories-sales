<?php

namespace Drupal\version_information;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\system\SystemManager;
use Drupal\system\Controller\SystemInfoController;

/**
 * Main service class.
 */
class VersionInformationManager implements VersionInformationManagerInterface {

  use StringTranslationTrait;

  /**
   * System manager.
   *
   * @var Drupal\system\SystemManager
   */
  protected $systemManager;

  /**
   * Module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructor method.
   *
   * @param \Drupal\system\SystemManager $system_manager
   */
  public function __construct(SystemManager $system_manager, ModuleHandlerInterface $module_handler) {
    $this->systemManager = $system_manager;
    $this->moduleHandler = $module_handler;
  }

  /**
   * Build a renderable array of the system information.
   */
  public function buildRenderableSystemInformation() {
    $versionInformation = new SystemInfoController($this->systemManager);
    $result = $versionInformation->status();
    $build = [
      '#theme' => 'version_information_theme',
      '#items' => [
        'drupal' => [
          'type' => 'drupal',
          'label' => $this->t('Drupal Version'),
          'value' => $result['#requirements']['drupal'],
        ],
        'cron' => [
          'type' => 'cron',
          'label' => $this->t('Last Cron Run'),
          'value' => $result['#requirements']['cron'],
        ],
        'server_software' => [
          'type' => 'server',
          'label' => $this->t('Web Server'),
          'value' => $result['#requirements']['webserver'],
        ],
        'php' => [
          'type' => 'php',
          'label' => $this->t('PHP version'),
          'value' => $result['#requirements']['php'],
        ],
        'database' => [
          'type' => 'database',
          'label' => $this->t('Database version and system'),
          'value' => [
            'system' => $result['#requirements']['database_system'],
            'version' => $result['#requirements']['database_system_version'],
          ],
        ],
      ],
    ];
    // Allow external modules to alter version information.
    $this->moduleHandler->invokeAll('version_information_build_alter', [$this->systemManager, $this->moduleHandler, &$build]);

    return $build;
  }

}
