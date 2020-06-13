<?php namespace MyBC\News\Model;

use MyBC\News\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Post  extends \Magento\Framework\Model\AbstractModel implements PostInterface, IdentityInterface {

    /**#@+
     * Post's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'news_post';

    protected $_cacheTag = 'news_post';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'news_post';

    protected function _construct() {
        $this->_init('MyBC\News\Model\ResourceModel\Post');
    }

    /**
     * Check if post url key exists
     * return post id if post exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key) {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    /**
     * Prepare post's statuses.
     * Available event news_post_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses() {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId() {
        return $this->getData(self::POST_ID);
    }

    public function getUrlKey() {
        return $this->getData(self::URL_KEY);
    }

    public function getTitle() {
        return $this->getData(self::TITLE);
    }

    public function getContent() {
        return $this->getData(self::CONTENT);
    }

    public function getCreationTime() {
        return $this->getData(self::CREATION_TIME);
    }

    public function isActive() {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function setId($id) {
        return $this->setData(self::POST_ID, $id);
    }

    public function setUrlKey($url_key) {
        return $this->setData(self::URL_KEY, $url_key);
    }

    public function setTitle($title) {
        return $this->setData(self::TITLE, $title);
    }

    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    public function setCreationTime($creation_time) {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    public function setIsActive($is_active) {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

}
