<?php
namespace MyBC\News\Block;

class PostView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface {

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \MyBC\News\Model\Post $post,
        \MyBC\News\Model\PostFactory $postFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_post = $post;
        $this->_postFactory = $postFactory;
    }

    /**
     * @return \MyBC\News\Model\Post
     */
    public function getPost() {
        if (!$this->hasData('post')) {
            if ($this->getPostId()) {
                /** @var \MyBC\News\Model\Post $page */
                $post = $this->_postFactory->create();
            } else {
                $post = $this->_post;
            }
            $this->setData('post', $post);
        }
        return $this->getData('post');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities() {
        return [\MyBC\News\Model\Post::CACHE_TAG . '_' . $this->getPost()->getId()];
    }

}
