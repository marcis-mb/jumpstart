<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.20.4
 * Time: 15:56
 */

namespace Marco\FirstPage\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public function execute()
    {
        /** @var $jsonResult */
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResult->setData([
            'message' => 'My First Page'
        ]);
        return $jsonResult;
    }
}
