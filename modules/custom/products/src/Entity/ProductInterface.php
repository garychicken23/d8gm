<?php

namespace Drupal\products\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Represents a Product entity.
 */
interface ProductInterface extends ContentEntityInterface, EntityChangedInterface {
    /**
     * Gets the Product name.
     * 
     * @return string
     */
    public function getName();

    /**
     * Sets the Product Name.
     * 
     * @param string $name
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   The called Product entity. 
     */
    public function setName($name);

    /**
     * Gets the product number.
     * 
     * @return int
     */
    public function getProductNumber();

    /**
     * Sets the product number.
     * 
     * @param int $number
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   the called product entity.
     */
    public function setProductNumber($number);

    /**
     * Gets the product remote ID.
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   the called product entity
     */
    public function getRemoteId();

    /**
     * Sets the product remote ID.
     * 
     * @param string $id
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   the called product entity
     */
    public function setRemoteId($id);

    /**
     * Gets the product source.
     * 
     * @return string
     */
    public function getSource();

    /**
     * Sets the product source.
     * 
     * @param string $source
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   the called entity.
     */
    public function setSource($source);

    /**
     * Gets the product creation timestamp.
     * 
     * @return int
     */
    public function getCreatedTime();

    /**
     * Sets the product creation timestamp.
     * 
     * @param int $timestamp
     * 
     * @return \Drupal\products\Entity\ProductInterface
     *   the called product entity.
     */
    public function setCreatedTime($timestamp);
}