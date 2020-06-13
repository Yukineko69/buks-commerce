<?php
namespace MyBC\News\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action {
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * News Index, shows a list of recent News posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {
        $post_id = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));
        /** @var \MyBC\News\Helper\Post $post_helper */
        $post_helper = $this->_objectManager->get('MyBC\News\Helper\Post');
        $result_page = $post_helper->prepareResultPost($this, $post_id);
        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }
}
