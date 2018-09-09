<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class City
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $owmId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $lon;
}