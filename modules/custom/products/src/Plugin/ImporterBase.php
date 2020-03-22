<?php

namespace Drupal\products\Plugin;

use Drupal\Component\Plugin\Exception\PluginException;
use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\products\Entity\ImporterInterface;
use Drupal\products\Plugin\ImporterInterface as ImporterPluginInterface;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base class for importer plugins.
 */
abstract class ImporterBase extends PluginBase implements
ImporterPluginInterface, ContainerFactoryPluginInterface {
    /**
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $configuration, $plugin_id, 
    $plugin_definition, EntityTypeManagerInterface $entityTypeManager, Client $httpClient) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->entityTypeManager = $entityTypeManager;

        $this->httpClient = $httpClient;

        if(!isset($configuration['config'])) {
            throw new PluginException('missing importer configuration');
        }

        if(!$configuration['config'] instanceof ImporterInterface) {

            throw new PluginException('wrong importer configuration');
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, 
    $plugin_id, $plugin_definition) {
        return new static(
            $configuration, 
            $plugin_id, 
            $plugin_definition,
            $container->get('entity_type.manager'),
            $container->get('http_client')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig() {
        return $this->configuration['config'];
    }
}