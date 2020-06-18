<?php
namespace MyBC\ProductById\Model;

use MyBC\ProductById\Api\ProductByIdInterface;

class ProductById implements ProductByIdInterface {

    /**
    * @var \Magento\Framework\Api\SearchCriteriaBuilder
    */
    protected $searchCriteriaBuilder;

    /**
    * @var \Magento\Catalog\Api\ProductRepositoryInterface
    */
    protected $productRepository;

    /**
    * @var \Magento\Framework\Api\FilterBuilder
    */
    protected $filterBuilder;

    /**
    * @var \Magento\Framework\Api\Search\FilterGroup
    */
    protected $filterGroup;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup) {

        $this->productRepository = $productRepository;
        $this->searchCriteria = $searchCriteria;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroup = $filterGroup;
    }

    /**
    * {@inheritdoc}
    */
    public function getProductById($id) {
        $result = $this->productRepository->getById($id);
        return $result;
    }
}
