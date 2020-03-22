<?php

namespace Drupal\products\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for creating/editing product entities.
 */
class ProductForm extends ContentEntityForm {
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var $entity \Drupal\products\Entity\Product */
        $form = parent::buildForm($form, $form_state);
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $entity = &$this->entity;

        $status = parent::save($form, $form_state);

        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('created the %label product.', [
                    '%label' => $entity->label()
                    ])
                );
            
            default:
                drupal_set_message($this->t('Saved the %label product', [
                    '%label' => $entity->label()
                ])
            );
        }

        $form_state->setRedirect('entity.product.canonical', [
            'product' => $entity->id()
        ]);

    }
}