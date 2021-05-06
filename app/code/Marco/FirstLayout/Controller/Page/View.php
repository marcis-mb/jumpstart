<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.21.4
 * Time: 07:16
 */


namespace Marco\FirstLayout\Controller\Page;


use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Element\Template;

class View extends Action
{
    public function execute()
    {
        /** @var Page $resultPage */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        /** @var Template $block */
        $block = $page->getLayout()->getBlock('marco.first.layout.example');

        $block->setData('custom_parameter', 'Data from the Controller');

        return $page;
    }

}
