<?php

namespace Drupal\products\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Url;

/**
 * Defines the importer entity
 * 
 * @ConfigEntityType (
 *   id = "importer",
 *   label = @Translation("importer label"),
 *   handlers = {
 *     "list_builder" = "Drupal\products\ImporterListBuilder",
 *     "form" = {
 *       "add" = "Drupal\products\Form\ImporterForm",
 *       "edit" = "Drupal\products\Form\ImporterForm",
 *       "delete" = "Drupal\products\Form\ImporterDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "importer",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/importer/add",
 *     "edit-form" = "/admin/structure/importer/{importer}/edit",
 *     "delete-form" = "/admin/structure/importer/{importer}/delete",
 *     "collection" = "/admin/structure/importer",
 *   }
 * )
 */
class Importer extends ConfigEntityBase implements ImporterInterface {

    /**
     * the importer id
     * 
     * @var string
     */
    protected $id;


    /**
     * the importer label
     * 
     * @var string
     */
    protected $label;

    /**
     * the url from where the import file can be retrieved.
     * 
     * @var string
     */
    protected $url;


    /**
     * the plugin ID of the plugin to be used for processing this import.
     * 
     * @var string
     */
    protected $plugin;


    /**
     * whether or not to update existing products if they have already been imported. 
     * 
     * @var bool
     */
    protected $update_existing = TRUE;


    /**
     * source of the products
     * 
     * @var string
     */
    protected $source;


    /**
     * {@inheritdoc}
     */
    public function getUrl() {
        return $this->url ? Url::fromUri($this->url) : NULL;
    }


    /**
     * {@inheritdoc}
     */
    public function getPluginId() {
        return $this->plugin;
    }


    /**
     * {@inheritdoc}
     */
    public function updateExisting() {
        return $this->update_existing;
    }


    /**
     * {@inheritdoc}
     */
    public function getSource() {
        return $this->source;
    }
}

