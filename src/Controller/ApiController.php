<?php

namespace App\Controller;

use App\DataProvider\LocationDataProvider;
use App\Model\Location;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\Version;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Version("v1.0")
 */
class ApiController extends FOSRestController
{
    /**
     * @Rest\Get("/api/{version}/current")
     * @Rest\QueryParam(name="lat", requirements="^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$", default="null")
     * @Rest\QueryParam(name="lon", requirements="^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$", default="null")
     */
    public function currentWeather(
        ParamFetcher $paramFetcher,
        LocationDataProvider $locationDataProvider,
        SerializerInterface $serializer
    ): JsonResponse {
        $lat = $paramFetcher->get('lat');
        $lon = $paramFetcher->get('lon');

        $location = new Location($lat, $lon);
        $response = $locationDataProvider->getCurrentDataForLocation($location);

        return new JsonResponse(
            $serializer->serialize($response, 'json'),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
