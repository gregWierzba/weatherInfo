<?php

namespace App\Model;

use JMS\Serializer\Annotation as JMS;

class Weather
{
    /**
     * @var int
     * @JMS\Type("int")
     */
    private $general;

    /**
     * @var float
     * @JMS\Type("float")
     */
    private $temp;

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

    public function __construct(int $general, float $temp, int $pressure, int $humidity)
    {
        $this->general = $general;
        $this->temp = $temp;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
    }
}