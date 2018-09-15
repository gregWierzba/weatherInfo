<?php

namespace App\OpenWeatherMap\Response;

use JMS\Serializer\Annotation as JMS;

class WeatherDescription
{
    /**
     * @var int
     * @JMS\Type("int")
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}