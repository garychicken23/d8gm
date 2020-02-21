<?php

namespace Drupal\greet\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\greet\DefaultService as GreetDS;
use Drupal\Core\Form\FormStateInterface;

/**
 * Greet Block
 * 
 * @Block(
 *  id = "greet_block_id",
 *  admin_label = @Translation("admin block label"),
 * )
 */
class GreetBlock extends BlockBase implements ContainerFactoryPluginInterface {
    protected $greet;

    public function __construct(array $configuration, $plugin_id, $plugin_definition, GreetDS $greet) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->greet = $greet;
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('greet.from_current_user'),
        );
    }

    public function build() {
        return [
            '#markup' => $this->greet->getUsername(),
        ];
    }


    // let's add some configs
    public function defaultConfiguration() {
        return [
            'enabled' => 1,
        ];
    }

    public function blockForm($form, FormStateInterface $form_state) {
        $config = $this->getConfiguration();

        $form['enabled'] = array(
            '#type' => 'checkbox',
            '#title' => t('Enabled title'),
            '#description' => t('box description'),
            '#default_value' => $config['enabled'],
        );

        return $form;
    }

    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['enabled'] = $form_state->getValue('enabled');
    }

}

