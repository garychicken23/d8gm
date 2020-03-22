<?php

namespace Drupal\products\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * defines an interface for importer plugins.
 */
interface ImporterInterface extends PluginInspectionInterface {
    /**
     * performs the import. return TRUE if the import was successful or FALSE otherwise.
     * 
     * @return bool
     */
    public function import();


    /**
     * returns the importer config entity.
     * 
     * @return \Drupal\products\Entity\ImporterInterface
     */
    public function getConfig();
}