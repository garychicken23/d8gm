<?php

namespace Drupal\products\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * defines a importer item annotation object.
 * 
 * @see \Drupal\products\Plugin\ImporterManager
 * 
 * @Annotation
 */
class Importer extends Plugin {
    /**
     * the plugin ID
     * 
     * @var string
     */
    public $id;

    /**
     * the label of the plugin
     * 
     * @var \Drupal\Core\Annotation\Translation
     * 
     * @ingroup plugin_translatable
     */
    public $label;
}