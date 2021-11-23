<?php

declare(strict_types=1);

namespace Monogo\Task\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const XML_PATH_ENABLED = 'monogo_weather/general/enabled';
    private const XML_PATH_API_LINK = 'monogo_weather/general/api_link';
    private const XML_PATH_CRON_EXP = 'monogo_weather/general/cron_schedule';
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getIsEnabled(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_ENABLED
        );
    }

    public function getApiLink(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_API_LINK
        );
    }

    public function getCronTime(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_CRON_EXP
        );
    }
}
