<?php

namespace App\OpenWeatherMap\Response;

use JMS\Serializer\Annotation as JMS;

class WeatherMain
{
    /**
     * @var float
     * @JMS\Type("float")
     */
    private $temp;

    /**
     * @var float
     * @JMS\Type("float")
     */
    private $temp_min;

    /**
     * @var float
     * @JMS\Type("float")
     */
    private $temp_max;

    /**
     * @var int
     * @JMS\Type("int")
     */
    private $pressure;

    /**
     * @var int
     * @JMS\Type("int")
     */
    private $humidity;


}