<?php
namespace MyBC\ProductById\Api;

interface ProductByIdInterface {

    /**
    * GET product identified by its id
    *
    * @api
    * @param string $id
    * @return \Magento\Catalog\Api\Data\ProductInterface
    * @throws \Magento\Framework\Exception\NoSuchEntityException
    */
    public function getProductById($id);
}
