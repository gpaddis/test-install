<?php

/**
* This observer listens for a catalog_product_save_after event and appends
* the brand name to the product name.
*/
class Lemundo_Brand_Model_Observer
{
    /**
     * Append the brand to the product name before it is persisted in the database.
     *
     * @return void
     */
    public function appendBrandName($observer)
    {
        $brandName = Mage::getStoreConfig('brand_options/testaufgabe/brand');
        $product = $observer->getEvent()->getProduct();

        $newName = $product->getName() . $brandName;
        $product->setName($newName);
    }
}
