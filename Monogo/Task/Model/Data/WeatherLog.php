<?php
declare(strict_types=1);

namespace Monogo\Task\Model\Data;

use Monogo\Task\Api\Data\WeatherLogInterface;

class WeatherLog implements WeatherLogInterface
{
    /**
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     */
    private ?string $mainDescription = null;

    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @var float|null
     */
    private ?float $windSpeed = null;

    /**
     * @var float|null
     */
    private ?float $clouds = null;

    /**
     * @var float|null
     */
    private ?float $temp = null;

    /**
     * @var float|null
     */
    private ?float $feelsLike = null;

    /**
     * @var float|null
     */
    private ?float $tempMin = null;

    /**
     * @var float|null
     */
    private ?float $tempMax = null;

    /**
     * @var int|null
     */
    private ?int $timestamp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): WeatherLogInterface
    {
        $this->id = $id;
        return $this;
    }

    public function getMainDescription(): ?string
    {
        return $this->mainDescription;
    }

    public function setMainDescription(?string $data): WeatherLogInterface
    {
        $this->mainDescription = $data;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $data): WeatherLogInterface
    {
        $this->description = $data;
        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(?float $data): WeatherLogInterface
    {
        $this->windSpeed = $data;
        return $this;
    }

    public function getClouds(): ?float
    {
        return $this->clouds;
    }

    public function setClouds(?float $data): WeatherLogInterface
    {
        $this->clouds = $data;
        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(?float $data): WeatherLogInterface
    {
        $this->temp = $data;
        return $this;
    }

    public function getFeelsLike(): ?float
    {
        return $this->feelsLike;
    }

    public function setFeelsLike(?float $data): WeatherLogInterface
    {
        $this->feelsLike = $data;
        return $this;
    }

    public function getTempMin(): ?float
    {
        return $this->tempMin;
    }

    public function setTempMin(?float $data): WeatherLogInterface
    {
        $this->tempMin = $data;
        return $this;
    }

    public function getTempMax(): ?float
    {
        return $this->tempMax;
    }

    public function setTempMax(?float $data): WeatherLogInterface
    {
        $this->tempMax = $data;
        return $this;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(?int $data): WeatherLogInterface
    {
        $this->timestamp = $data;
        return $this;
    }
}
