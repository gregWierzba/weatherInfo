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
     */
    private $weather;

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
}