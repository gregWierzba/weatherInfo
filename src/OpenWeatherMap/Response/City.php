<?php

namespace App\OpenWeatherMap\Response;

use JMS\Serializer\Annotation as JMS;

class City
{
    /**
     * @var int
     * @JMS\Type("int")
     */
    private $id;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @var array
     * @JMS\Type("array")
     */
    private $coord;

    /**
     * @var WeatherMain
     * @JMS\Type("App\OpenWeatherMap\Response\WeatherMain")
     */
    private $main;

    /**
     * @var array
     * @JMS\Type("array<App\OpenWeatherMap\Response\WeatherDescription>")
     * @JMS\SerializedName("weather")
     */
    private $weatherDesc;

    /**
     * @var \DateTime
     * @JMS\Type("int")
     * @JMS\SerializedName("dt")
     * @JMS\Accessor(setter="setDate")
     */
    private $date;

    public function setDate(int $timestamp)
    {
        $this->date = new \DateTime("@$timestamp");
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCoord(): array
    {
        return $this->coord;
    }

    public function getMain(): WeatherMain
    {
        return $this->main;
    }

    public function getWeatherDesc(): array
    {
        return $this->weatherDesc;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}