<?php

namespace App\Model;


class Weather
{
    /**
     * @var int
     */
    private $general;

    /**
     * @var float
     */
    private $temp;

    /**
     * @var int
     */
    private $pressure;

    /**
     * @var int
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