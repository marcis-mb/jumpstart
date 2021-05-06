<?php
/**
 * Created by PhpStorm.
 * User: marcispumpurs
 * Date: 21.20.4
 * Time: 16:22
 */

namespace Marco\FirstPage\Controller\Custom;


use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;


class View extends Action
{
    public function execute()
    {
        $jsonObject = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonObject->setData([
            'message' => 'Hello from Marco custom module'
        ]);
        return $jsonObject;
    }

}
