<?php

/**
* The observer listens for a catalog_product_save_before event and appends
* the brand name to the product name each time a product is saved.
*/
class Lemundo_Brand_Model_Observer
{
    /**
     * Append the brand to the product name before it is persisted in the database.
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Lemundo_Brand_Model_Observer
     */
    public function appendBrandName(Varien_Event_Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $productName = $product->getName();
        $brandName = Mage::getStoreConfig('brand_options/testaufgabe/brand');

        $product->setName($productName . $brandName);

        return $this;
    }
}
