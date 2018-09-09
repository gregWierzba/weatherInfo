<?php

namespace App\OpenWeatherMap\Response;

use JMS\Serializer\Annotation as JMS;

class CityWeather
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

}