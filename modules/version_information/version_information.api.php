<?php

/**
 * @file
 * Hooks for the version_information module.
 */

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\system\SystemManager;

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter version information before being displayed.
 */
function hook_version_information_build_alter(SystemManager $system_manager, ModuleHandlerInterface $module_handler, array &$build) {
}

/**
 * @} End of "addtogroup hooks".
 */
