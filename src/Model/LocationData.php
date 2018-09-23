<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class LocationData
{
    /**
     * @var Weather
     * @JMS\Type("App\Model\Weather")
     */
    private $currentWeather;

    public function __construct(Weather $currentWeather)
    {
        $this->currentWeather = $currentWeather;
    }

    public function getCurrentWeather(): Weather
    {
        return $this->currentWeather;
    }
}