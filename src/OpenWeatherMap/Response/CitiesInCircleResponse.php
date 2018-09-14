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
     * @JMS\Type("array<App\OpenWeatherMap\Response\City>")
     */
    private $list;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getList(): array
    {
        return $this->list;
    }
}