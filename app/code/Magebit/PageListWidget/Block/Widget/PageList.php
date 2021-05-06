<?php
/**
 * This file is part of the Magebit PageListWidget module.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit PageListWidget
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2021 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Magebit\PageListWidget\Block\Widget;

/**
 * Widget to display list of links to CMS pages
 */
class PageList extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{

    /**
     * @var \Magento\Cms\Api\PageRepositoryInterface
     */
    protected $pageRepositoryInterface;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Widget template attribute
     *
     * @var string
     */
    protected $_template = "page-list.phtml";


    /**
     * PageList constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Store\Model\StoreManagerInterface
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
    }


    /**
     * Prepare collection of pages using search criteria.
     *
     * @return array|\Magento\Cms\Api\Data\PageInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getPageList()
    {
        $pageList = [];
        $pageIdentifierArray = explode(",", $this->getData('pageIdentifiers'));
        $searchCriteriaInterface = $this->searchCriteriaBuilder
            ->addFilter('identifier', $pageIdentifierArray, 'in')
            ->addFilter('is_active', '1', 'eq')
            ->addFilter('store_id', [0, $this->storeManager->getStore()->getId()], 'eq')
            ->create();

        try{
           $pageList = $this->pageRepositoryInterface->getList($searchCriteriaInterface)->getItems();
        }catch(\Exception $e){}

        return $pageList;
    }


}
