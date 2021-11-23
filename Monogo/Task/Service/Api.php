<?php

declare(strict_types=1);

namespace Monogo\Task\Service;

use Magento\Framework\HTTP\Client\Curl;

class Api
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var Curl
     */
    private Curl $curl;

    /**
     * @param Config $config
     * @param Curl $curl
     */
    public function __construct(
        Config $config,
        Curl $curl
    ) {
        $this->config = $config;
        $this->curl = $curl;
    }

    /**
     * @return string
     */
    public function getNewWeatherData()
    {
        $this->curl->get($this->config->getApiLink());
        return $this->curl->getBody();
    }
}
