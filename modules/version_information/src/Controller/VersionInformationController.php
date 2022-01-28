<?php

namespace Drupal\version_information\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\version_information\VersionInformationManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class VersionInformationController.
 */
class VersionInformationController extends ControllerBase {

  /**
   * The version information manager.
   *
   * @var \Drupal\version_information\VersionInformationManagerInterface
   */
  protected $versionInformationManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(VersionInformationManagerInterface $version_information_manager) {
    $this->versionInformationManager = $version_information_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('version_information.manager')
    );
  }

  /**
   * Displays the site status report.
   *
   * @return array
   *   A render array containing a list of system requirements for the Drupal
   *   installation and whether this installation meets the requirements.
   */
  public function status() {
    return $this->versionInformationManager->buildRenderableSystemInformation();
  }

}
