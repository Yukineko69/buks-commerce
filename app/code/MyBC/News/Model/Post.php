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
    const CACHE_TAG = 'News_post';

    protected $_cacheTag = 'News_post';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'News_post';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('MyBC\News\Model\ResourceModel\Post');
    }

    /**
     * Check if post url exists
     * return post id if post exists
     *
     * @param string $url
     * @return int
     */
    public function checkUrl($url) {
        return $this->_getResource()->checkUrl($url);
    }

    /**
     * Prepare post's statuses.
     * Available event blog_post_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
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

    public function getUrl() {
        return $this->getData(self::URL);
    }

    public function getTitle() {
        return $this->getData(self::TITLE);
    }

    public function getContent() {
        return $this->getData(self::CONTENT);
    }

    public function isActive() {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function getPublishedDate() {
        return $this->getData(self::PUBLISHED_DATE);
    }

    public function setId($id) {
        return $this->setData(self::POST_ID, $id);
    }

    public function setUrl($url) {
        return $this->setData(self::URL, $url);
    }

    public function setTitle($title) {
        return $this->setData(self::TITLE, $title);
    }

    public function setContent($content) {
        return $this->setData(self::CONTENT, $content);
    }

    public function setIsActive($is_active) {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

    public function setPublishedDate($published_date) {
        return $this->setData(self::PUBLISHED_DATE, $published_date);
    }
}
