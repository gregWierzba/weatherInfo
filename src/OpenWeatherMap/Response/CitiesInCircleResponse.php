<?php

namespace App\OpenWeatherMap\Response;

use JMS\Serializer\Annotation as JMS;

class CitiesInCircleResponse
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $message;

    /**
     * @var array
     * @JMS\Type("array<App\OpenWeatherMap\Response\CityWeather>")
     */
    private $list;

}