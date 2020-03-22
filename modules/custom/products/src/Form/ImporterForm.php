<?php

namespace Drupal\products\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\products\Entity\Importer;
use Drupal\Core\Url;
use Drupal\products\Plugin\ImporterManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * form for creating/editing importer entities.
 */
class ImporterForm extends EntityForm {
    /**
     * @var \Drupal\products\Plugin\ImporterManager
     */
    protected $importerManager;

    /**
     * importerform constructor
     * 
     * @param \Drupal\products\Plugin\ImporterManager $importerManager
     */
    public function __construct(ImporterManager $importerManager) {
        $this->importerManager = $importerManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('products.importer_manager')
        );
    }


    /**
     * {@inheritdoc}
     */
    public function form(array $form, FormStateInterface $form_state) {
        $form = parent::form($form, $form_state);

        /** @var importer $importer */
        $importer = $this->getEntity();

        $form['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('name'),
            '#maxlength' => 255,
            '#default_value' => $importer->label(),
            '#description' => $this->t('name of the importer'),
            '#required' => TRUE,
        ];

        $form['id'] = [
            '#type' => 'machine_name',
            '#default_value' => $importer->id(),
            '#machine_name' => [
                'exists' => '\Drupal\products\Entity\Importer::load',
            ],
            '#disabled' => !$importer->isNew(),// disable if it is not new
        ];

        $form['url'] = [
            '#type' => 'url',
            '#default_value' => $importer->getUrl() instanceof Url ? $importer->getUrl()->toString() : '',
            '#title' => $this->t('Url'),
            '#description' => $this->t('the url to the import resource'),
            '#required' => TRUE,
        ];


        // kint($this);exit();


        $definitions = $this->importerManager->getDefinitions();

        $options = [];

        foreach ($definitions as $id => $definition) {
            $options[$id] = $definition['label'];

            // kint($definitions);exit();

        }

        $form['plugin'] = [
            '#type' => 'select',
            '#title' => $this->t('plugin'),
            '#default_value' => $importer->getPluginid(),
            '#options' => $options,
            '#description' => $this->t('the plugin to be used with this importer'),
            '#required' => TRUE,
        ];

        $form['update_existing'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('update existing'),
            '#description' => $this->t('whether or not to update existing products'),
            '#default_value' => $importer->updateExisting(),
        ];

        $form['source'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Source'),
            '#description' => $this->t('the source of the products'),
            '#default_value' => $importer->getSource(),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        /**@var importer $importer */
        $importer = $this->entity;
        $status = $importer->save();

        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('created the %label importer.', [
                    '%label' => $importer->label(),
                ]));
                break;

            default:
                drupal_set_message($this->t('saved the %label importer', [
                    '%label' => $importer->label(),
                ]));
        }


        $form_state->setRedirectUrl($importer->toUrl('collection'));
    }
}























