<?php
namespace MyBC\News\Controller\Index;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * News Index, shows a list of recent news posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {
        return $this->resultPageFactory->create();
    }
}
