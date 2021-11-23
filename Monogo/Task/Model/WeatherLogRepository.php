<?php
declare(strict_types=1);

namespace Monogo\Task\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Monogo\Task\Api\Data\WeatherLogInterface;
use Monogo\Task\Api\WeatherLogRepositoryInterface;
use Monogo\Task\Model\ResourceModel\WeatherLog as ResourceModel;
use Monogo\Task\Model\ResourceModel\WeatherLog\CollectionFactory;
use Monogo\Task\Model\WeatherLogFactory;

class WeatherLogRepository implements WeatherLogRepositoryInterface
{
    /**
     * @var \Monogo\Task\Model\ResourceModel\WeatherLog\
     */
    private ResourceModel $resourceModel;

    /**
     * @var \Monogo\Task\Model\WeatherLogFactory
     */
    private WeatherLogFactory $weatherLogFactory;

    /**
     * @var \Monogo\Task\Model\ResourceModel\WeatherLog\CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessor
     */
    private CollectionProcessor $collectionProcessor;

    /**
     * @var \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    private SearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    private DataObjectProcessor $dataObjectProcessor;

    /**
     * @param ResourceModel $resourceModel
     * @param WeatherLogFactory $weatherLogFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessor $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        ResourceModel $resourceModel,
        WeatherLogFactory $weatherLogFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessor $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->resourceModel = $resourceModel;
        $this->weatherLogFactory = $weatherLogFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): WeatherLogInterface
    {
        /** @var \Monogo\Task\Model\WeatherLog $weatherLogModel */
        $weatherLogModel = $this->weatherLogFactory->create();
        $this->resourceModel->load($weatherLogModel, $id);

        if ($weatherLogModel->getId() === null) {
            throw new NotFoundException(__('Error code does not exist.'));
        }

        return $weatherLogModel->getDataModel();
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->count());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function save(WeatherLogInterface $weatherLog): WeatherLogInterface
    {
        try {
            $data = $this->dataObjectProcessor->buildOutputDataArray($weatherLog, WeatherLogInterface::class);

            $weatherLogModel = $this->weatherLogFactory->create();
            $this->resourceModel->load($weatherLogModel, $weatherLog->getId());

            $weatherLogModel->addData($data);

            $this->resourceModel->save($weatherLogModel);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()), $e);
        }

        return $weatherLogModel->getDataModel();
    }

    /**
     * @inheritDoc
     */
    public function delete(WeatherLogInterface $weatherLog): bool
    {
        return $this->deleteById($weatherLog->getId());
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        try {
            $weatherLogModel = $this->weatherLogFactory->create();
            $this->resourceModel->load($weatherLogModel, $id);
            $this->resourceModel->delete($weatherLogModel);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()), $e);
        }

        return true;
    }
}
