<?php namespace MyBC\News\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected $_idFieldName = 'post_id';

    protected function _construct(){
        $this->_init('MyBC\News\Model\Post', 'MyBC\News\Model\ResourceModel\Post');
    }
}
