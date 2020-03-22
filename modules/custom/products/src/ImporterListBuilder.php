<?php

namespace Drupal\products;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * provides a listing of importer entities.
 */
class ImporterListBuilder extends ConfigEntityListBuilder {
    /**
     * {@inheritdoc}
     */
    public function buildHeader() {
        $header['label'] = $this->t('importer');
        $header['id'] = $this->t('machine name');
        return $header + parent::buildHeader();
    }

    /**
     * {@inheritdoc}
     */
    public function buildRow(EntityInterface $entity) {
        $row['label'] = $entity->label();
        $row['id'] = $entity->id();
        return $row + parent::buildRow($entity);
    }
}