<?php
declare(strict_types=1);

namespace Monogo\Task\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class WeatherLog extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'api_sync_weather_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('api_sync_weather', 'id');
    }
}
