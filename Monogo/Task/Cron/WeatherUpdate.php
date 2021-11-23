<?php

declare(strict_types=1);

namespace Monogo\Task\Cron;

use Magento\Framework\Serialize\SerializerInterface;
use Monogo\Task\Model\WeatherLogFactory;
use Monogo\Task\Service\Api;
use Monogo\Task\Model\WeatherLogRepository;

class WeatherUpdate
{
    const KELVIN = '273.15';

    private WeatherLogFactory $weatherLogFactory;

    private SerializerInterface $serializer;

    private WeatherLogRepository $weatherLogRepository;

    private Api $weatherApi;

    /**
     * @param WeatherLogFactory $weatherLogFactory
     * @param SerializerInterface $serializer
     * @param Api $weatherApi
     */
    public function __construct(
        WeatherLogFactory    $weatherLogFactory,
        SerializerInterface  $serializer,
        WeatherLogRepository $weatherLogRepository,
        Api                  $weatherApi
    )
    {
        $this->weatherLogFactory = $weatherLogFactory;
        $this->serializer = $serializer;
        $this->weatherLogRepository = $weatherLogRepository;
        $this->weatherApi = $weatherApi;
    }

    public function execute(): void
    {
        $weatherData = $this->weatherApi->getNewWeatherData();
        $weatherDataArray = $this->serializer->unserialize($weatherData);

        /** @var \Monogo\Task\Api\Data\WeatherLogInterface $weatherLog */

        $weatherLog = $this->weatherLogFactory->create();

        $weatherLog->setClouds($weatherDataArray['clouds']['all'] ?? null);
        $weatherLog->setDescription($weatherDataArray['weather'][0]['description'] ?? null);
        $weatherLog->setMainDescription($weatherDataArray['weather'][0]['main'] ?? null);
        $weatherLog->setFeelsLike($weatherDataArray['main']['feels_like'] ? $this->kelvinToCelsius($weatherDataArray['main']['feels_like']) : null);
        $weatherLog->setTemp($weatherDataArray['main']['temp'] ?? null);
        $weatherLog->setTempMax($weatherDataArray['main']['temp_max'] ? $this->kelvinToCelsius($weatherDataArray['main']['temp_max']) : null);
        $weatherLog->setTempMin($weatherDataArray['main']['temp_min'] ? $this->kelvinToCelsius($weatherDataArray['main']['temp_min']) : null);
        $weatherLog->setWindSpeed($weatherDataArray['wind']['speed'] ?? null);

        $this->weatherLogRepository->save($weatherLog->getDataModel());
    }

    private function kelvinToCelsius($kelvin)
    {
        return (float)$kelvin - self::KELVIN;
    }
}
