<?php

namespace MyBC\News\Plugin\Block;

use Magento\Framework\Data\Tree\NodeFactory;

class Topmenu {
    /**
     * @var NodeFactory
     */
    protected $nodeFactory;

    public function __construct(
        NodeFactory $nodeFactory
    ) {
        $this->nodeFactory = $nodeFactory;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        $node = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }

    protected function getNodeAsArray() {
        return [
            'name' => __('Tin tức'),
            'id' => 'mybc_news_navitem',
            'url' => './news',
            'has_active' => false,
            'is_active' => false // (expression to determine if menu item is selected or not)
        ];
    }
}
