<?php
declare(strict_types=1);

namespace Monogo\Task\Api\Data;

interface WeatherLogInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int|null $id
     * @return WeatherLogInterface
     */
    public function setId(?int $id): WeatherLogInterface;

    /**
     * @return string|null
     */
    public function getMainDescription(): ?string;

    /**
     * @param string|null $data
     * @return WeatherLogInterface
     */
    public function setMainDescription(?string $data): WeatherLogInterface;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $data
     * @return WeatherLogInterface
     */
    public function setDescription(?string $data): WeatherLogInterface;


    /**
     * @return float|null
     */
    public function getWindSpeed(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setWindSpeed(?float $data): WeatherLogInterface;


    /**
     * @return float|null
     */
    public function getClouds(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setClouds(?float $data): WeatherLogInterface;

    /**
     * @return float|null
     */
    public function getTemp(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setTemp(?float $data): WeatherLogInterface;

    /**
     * @return float|null
     */
    public function getFeelsLike(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setFeelsLike(?float $data): WeatherLogInterface;

    /**
     * @return float|null
     */
    public function getTempMin(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setTempMin(?float $data): WeatherLogInterface;

    /**
     * @return float|null
     */
    public function getTempMax(): ?float;

    /**
     * @param float|null $data
     * @return WeatherLogInterface
     */
    public function setTempMax(?float $data): WeatherLogInterface;

    /**
     * @return int|null
     */
    public function getTimestamp(): ?int;

    /**
     * @param int|null $data
     * @return WeatherLogInterface
     */
    public function setTimestamp(?int $data): WeatherLogInterface;
}
