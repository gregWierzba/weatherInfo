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

    public function getTemp(): float
    {
        return $this->temp;
    }

    public function getTempMin(): float
    {
        return $this->temp_min;
    }

    public function getTempMax(): float
    {
        return $this->temp_max;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }
}