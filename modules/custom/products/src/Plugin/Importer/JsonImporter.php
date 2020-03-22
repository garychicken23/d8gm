<?php

namespace Drupal\products\Plugin\Importer;

use Drupal\Products\Entity\ImporterInterface;
use Drupal\products\Entity\ProductInterface;
use Drupal\products\Plugin\ImporterBase;

/**
 * product importer from a json format.
 * 
 * @Importer(
 *   id = "json",
 *   label = @Translation("JSON Importer"),
 * )
 */
class JsonImporter extends ImporterBase {
    /**
     * {@inheritdoc}
     */
    public function import() {
        $data = $this->getData();
        if (!$data) {
            return FALSE;
        }

        if (!isset($data->products)) {
            return FALSE;
        }

        $products = $data->products;

        foreach($products as $product) {

            $this->persistProduct($product);
        }

        return TRUE;
    }


    /**
     * loads the product data from the remote url
     * 
     * @return \stdClass
     */
    private function getData() {
        /** @var ImporterInterface $config */
        $config = $this->configuration['config'];
        $request = $this->httpClient->get($config->getUrl()->toString());
        $string = $request->getBody()->getContents();

        return json_decode($string);
    }


    /**
     * saves a product entity from the remote data
     * 
     * @return \stdClass $data
     */
    private function persistProduct($data) {
        /** @var ImporterInterface $config  */
        $config = $this->configuration['config'];

        $existing = $this->entityTypeManager->getStorage('product')->loadByProperties([
            'remote_id' => $data->id,
            'source' => $config->getSource()
        ]);

        if(!$existing) {
            $values = [
                'remote_id' => $data->id,
                'source' => $config->getSource()
            ];

            /** @var productinterface $product */
            $product = $this->entityTypeManager->getStorage('product')->create($values);
            $product->setName($data->name);
            $product->setProductNumber($data->number);
            $product->save();
            return;
        }

        if (!$config->updateExisting()) {
            return;
        }

        /** @var productinterface $product */
        $product = reset($existing);
        $product->setName($data->name);
        $product->setProductNumber($data->number);
        $product->save();
    }
}