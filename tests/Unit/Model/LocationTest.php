<?php

namespace App\Tests\Unit\Model;

use App\Model\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testGetParameters()
    {
        $expectedLat = 15.4356;
        $expectedLon = 44.2457;
        $loc = new Location($expectedLat, $expectedLon);

        $this->assertEquals($loc->getLat(), $expectedLat);
        $this->assertEquals($loc->getLon(), $expectedLon);
    }
}