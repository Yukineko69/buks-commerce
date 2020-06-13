<?php
namespace MyBC\News\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('MyBC_News_post', 'post_id');
    }

    // /**
    //  * Process post data before saving
    //  *
    //  * @param \Magento\Framework\Model\AbstractModel $object
    //  * @return $this
    //  * @throws \Magento\Framework\Exception\LocalizedException
    //  */
    // protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object) {
    //
    //     if (!$this->isValidPostUrlKey($object)) {
    //         throw new \Magento\Framework\Exception\LocalizedException(
    //             __('The post url contains capital letters or disallowed symbols.')
    //         );
    //     }
    //
    //     if ($this->isNumericPostUrlKey($object)) {
    //         throw new \Magento\Framework\Exception\LocalizedException(
    //             __('The post url cannot be made of only numbers.')
    //         );
    //     }
    //
    //     if ($object->isObjectNew() && !$object->hasCreationTime()) {
    //         $object->setPublishedDate($this->_date->gmtDate());
    //     }
    //
    //     return parent::_beforeSave($object);
    // }

    /**
     * Load an object using 'url' field if there's no field specified and value is not numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param string $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null) {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'url';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \MyBC\News\Model\Post $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object) {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {

            $select->where(
                'is_active = ?',
                1
            )->limit(
                1
            );
        }

        return $select;
    }

    /**
     * Retrieve load select with filter by url and activity
     *
     * @param string $url
     * @param int $isActive
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadByUrlKeySelect($url, $isActive = null) {
        $select = $this->getConnection()->select()->from(
            ['bp' => $this->getMainTable()]
        )->where(
            'bp.url = ?',
            $url
        );

        if (!is_null($isActive)) {
            $select->where('bp.is_active = ?', $isActive);
        }

        return $select;
    }

    /**
     *  Check whether post url is numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isNumericPostUrlKey(\Magento\Framework\Model\AbstractModel $object) {
        return preg_match('/^[0-9]+$/', $object->getData('url'));
    }

    /**
     *  Check whether post url is valid
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isValidPostUrlKey(\Magento\Framework\Model\AbstractModel $object) {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('url'));
    }

    /**
     * Check if post url exists
     * return post id if post exists
     *
     * @param string $url
     * @return int
     */
    public function checkUrl($url) {
        $select = $this->_getLoadByUrlSelect($url, 1);
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.post_id')->limit(1);

        return $this->getConnection()->fetchOne($select);
    }
}
