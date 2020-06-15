<?php
namespace MyBC\LatestNews\Block;

class LatestNews extends \Magento\Framework\View\Element\Template {

	public function __construct(\Magento\Framework\View\Element\Template\Context $context) {
		parent::__construct($context);
	}

    // public function _prepareLayout() {
    //     // $this->pageConfig->getTitle()->set(__('Tin tức nổi bật'));
    // }

	public function sayHello() {
		return '';
	}
}
