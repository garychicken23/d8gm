<?php

namespace Drupal\products\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\Core\Url;

/**
 * importer configuration entity.
 */
interface ImporterInterface extends ConfigEntityInterface {
    /**
     * return the url where the import can get the data from
     * 
     * @return Url
     */
    public function getUrl();


    /**
     * return the importer plugin ID to be used by this importer.
     * 
     * @return string
     */
    public function getPluginId();

    
    /**
     * whether or not to update existing products if they have already been imported.
     * 
     * @return bool
     */
    public function updateExisting();


    /**
     * return the source of the products
     * 
     * @return string
     */
    public function getSource();

}