<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Location
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $lat;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $lon;

    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getLat(): float
    {
        return (float)$this->lat;
    }

    public function getLon(): float
    {
        return (float)$this->lon;
    }
}