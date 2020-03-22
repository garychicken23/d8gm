<?php

namespace Drupal\products\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

use Drupal\products\Entity\ImporterInterface;
use Drupal\products\Plugin\ImporterInterface as ImporterPluginInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * provides the importer plugin manager.
 */
class ImporterManager extends DefaultPluginManager {
    /**
     * ImporterManager constructor.
     * 
     * @param \Traversable $namespace
     *   An object that implements \Traversable which contains the root paths implementations.
     * @param \Drupal\Core\Cache\CacheBackedninterface $cache_backend
     *   Cache backend instance to use. \
     * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
     *   The module handler to invoke the alter hook with. 
     */
    public function __construct(\Traversable $namespace, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler, EntityTypeManagerInterface $entityTypeManager) {
        parent::__construct('Plugin/Importer', $namespace, $module_handler, 'Drupal\products\Plugin\ImporterInterface', 'Drupal\products\Annotation\Importer');

        $this->alterInfo('products_importer_info');

        $this->setCacheBackend($cache_backend, 'products_importer_plugins');
 
        $this->entityTypeManager = $entityTypeManager;
    }


    /**
     * creates an instance of importerinterface plugin based on the id of a config entity
     * 
     * @param $id
     *   configuration entity id
     * 
     * @return null|ImporterPluginInterface
     */
    public function createInstanceFromConfig($id) {
        $config = $this->entityTypeManager->getStorage('importer')->load($id);
        if (!$config instanceof ImporterInterface) {
            return NULL;
        }

        // kint($config);exit();

        return $this->createInstance($config->getPluginId(), [
            'config' => $config
        ]);
    }
}