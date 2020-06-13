<?php
namespace MyBC\News\Block;

use MyBC\News\Api\Data\PostInterface;
use MyBC\News\Model\ResourceModel\Post\Collection as PostCollection;

class PostList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface {

    /**
     * @var \MyBC\News\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_postCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \MyBC\News\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @return \MyBC\News\Model\ResourceModel\Post\Collection
     */
    public function getPosts() {
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    PostInterface::PUBLISHED_DATE,
                    PostCollection::SORT_ORDER_DESC
                );
            $this->setData('posts', $posts);
        }

        return $this->getData('posts');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\MyBC\News\Model\Post::CACHE_TAG . '_' . 'list'];
    }

}
