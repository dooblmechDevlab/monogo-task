<?php
declare(strict_types=1);

namespace Monogo\Task\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Monogo\Task\Api\Data\WeatherLogInterface;
use Monogo\Task\Api\Data\WeatherLogInterfaceFactory;
use Monogo\Task\Model\ResourceModel\WeatherLog as ResourceModel;
use Magento\Framework\Api\DataObjectHelper;

class WeatherLog extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'api_sync_weather_model';

    /**
     * @var WeatherLogInterfaceFactory
     */
    private WeatherLogInterfaceFactory $errorCodeFactory;


    /**
     * @var DataObjectHelper
     */
    private DataObjectHelper $dataObjectHelper;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param WeatherLogInterfaceFactory $errorCodeFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context                                       $context,
        Registry                                      $registry,
        WeatherLogInterfaceFactory                     $errorCodeFactory,
        DataObjectHelper                              $dataObjectHelper,
        AbstractResource                              $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array                                         $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);

        $this->errorCodeFactory = $errorCodeFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return WeatherLogInterface
     */
    public function getDataModel(): WeatherLogInterface
    {
        $weatherLog = $this->errorCodeFactory->create();
        try {
            $this->dataObjectHelper->populateWithArray(
                $weatherLog,
                $this->getData(),
                WeatherLogInterface::class
            );
        } catch (LocalizedException $e) {
        }

        return $weatherLog;
    }
}
