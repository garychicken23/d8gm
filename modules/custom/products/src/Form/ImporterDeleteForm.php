<?php
namespace Drupal\products\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * form for deleting importer entities
 */
class ImporterDeleteForm extends EntityConfirmFormBase {
    /**
     * {@inheritdoc}
     */
    public function getQuestion() {
        return $this->t('are you sure you watn to delete %name', [
            '%name' => $this->entity->label()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCancelUrl() {
        return new Url('entity.importer.collection');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfirmText() {
        return $this->t('delete');
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->entity->delete();

        drupal_set_message($this->t('delete @entity importer', [
            '@entity' => $this->entity->label()
        ]));

        $form_state->setRedirectUrl($this->getCancelUrl());
    }

}