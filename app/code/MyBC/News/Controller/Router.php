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
        $url = trim($request->getPathInfo(), '/News/');
        $url = rtrim($url, '/');

        /** @var \MyBC\News\Model\Post $post */
        $post = $this->_postFactory->create();
        $post_id = $post->checkUrl($url);
        if (!$post_id) {
            return null;
        }

        $request->setModuleName('News')
            ->setControllerName('view')
            ->setActionName('index')
            ->setParam('post_id', $post_id);
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $url);

        return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
    }
}
