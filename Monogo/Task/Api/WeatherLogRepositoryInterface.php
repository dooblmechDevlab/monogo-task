<?php

declare(strict_types=1);

namespace Monogo\Task\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Monogo\Task\Api\Data\WeatherLogInterface;

interface WeatherLogRepositoryInterface
{
    /**
     * @param int $id
     * @return \Monogo\Task\Api\Data\WeatherLogInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function get(int $id): WeatherLogInterface;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * @param \Monogo\Task\Api\Data\WeatherLogInterface $weatherLog
     * @return \Monogo\Task\Api\Data\WeatherLogInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(WeatherLogInterface $weatherLog): WeatherLogInterface;

    /**
     * @param \Monogo\Task\Api\Data\WeatherLogInterface $weatherLog
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(WeatherLogInterface $weatherLog): bool;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
