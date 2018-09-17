<?php

namespace App\Controller;

use App\OpenWeatherMap\NearestCitiesWeatherRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
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
    public function index(ParamFetcher $paramFetcher, NearestCitiesWeatherRepository $client): JsonResponse
    {
        $lat = $paramFetcher->get('lat');
        $lon = $paramFetcher->get('lon');

        $expectedResponseBody = [
            'weather' => [
                'general' => 500,
                'temp' => 28.5,
                'pressure' => 1013.75,
                'humidity' => 90
            ],
            'wind' => [
                'speed' => 5.85,
                'deg' => 289
            ],
            'clouds' => 75,
            'rain' => 3
        ];
        $client->getNearestCitiesWeather($lat, $lon, 3);
//        $request = new Request('GET', 'http://ip.jsontest.com/');
//        $resposne = $restClient->send($request);

        return new JsonResponse($expectedResponseBody, JsonResponse::HTTP_OK);
    }
}
