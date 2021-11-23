<?php
declare(strict_types=1);

namespace Monogo\Task\Model\ResourceModel\WeatherLog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Monogo\Task\Model\WeatherLog as Model;
use Monogo\Task\Model\ResourceModel\WeatherLog as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'api_sync_weather_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
