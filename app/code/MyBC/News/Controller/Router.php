<?php
namespace MyBC\News\Controller;

class Router implements \Magento\Framework\App\RouterInterface {
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Post factory
     *
     * @var \MyBC\News\Model\PostFactory
     */
    protected $_postFactory;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \MyBC\News\Model\PostFactory $postFactory
    ) {
        $this->actionFactory = $actionFactory;
        $this->_postFactory = $postFactory;
    }

    /**
     * Validate and Match News Post and modify request
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return bool
     */
    public function match(\Magento\Framework\App\RequestInterface $request) {
        $url_key = trim($request->getPathInfo(), '/news/');
        $url_key = rtrim($url_key, '/');

        /** @var \MyBC\News\Model\Post $post */
        $post = $this->_postFactory->create();
        $post_id = $post->checkUrlKey($url_key);
        if (!$post_id) {
            return null;
        }

        $request->setModuleName('news')
            ->setControllerName('view')
            ->setActionName('index')
            ->setParam('post_id', $post_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }
}
