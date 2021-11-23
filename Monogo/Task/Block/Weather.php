<?php
declare(strict_types=1);

namespace Monogo\Task\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Monogo\Task\Model\WeatherLogRepository;
use Monogo\Task\Model\ResourceModel\WeatherLog\CollectionFactory;
use Magento\Framework\Api\SortOrderBuilder;
use function GuzzleHttp\Psr7\try_fopen;

class Weather extends Template
{
    /**
     * @var WeatherLogRepository
     */
    private $weatherLogRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param WeatherLogRepository $weatherLogRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Context               $context,
        WeatherLogRepository  $weatherLogRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory     $collectionFactory,
        SortOrderBuilder      $sortOrderBuilder,
        array                 $data = []
    )
    {
        $this->weatherLogRepository = $weatherLogRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getLastWeatherData()
    {

        $sortOrders = [
            $this->sortOrderBuilder->setDirection(SortOrder::SORT_DESC)
                ->setField('timestamp')
                ->create(),
        ];
        $searchCriteria = $this->searchCriteriaBuilder->setSortOrders($sortOrders)->setPageSize(1)->create();
        $items = $this->weatherLogRepository->getList($searchCriteria)->getItems();
        return !empty($items) ? array_pop($items) : null;
    }
}
