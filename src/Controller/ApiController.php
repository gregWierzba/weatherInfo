<?php

namespace App\Controller;

use App\OpenWeatherMap\NearestCitiesWeatherRepository;
use FOS\RestBundle\Controller\FOSRestController;
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
     */
    public function index(NearestCitiesWeatherRepository $client): JsonResponse
    {
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
        $client->getNearestCitiesWeather(50.082961, 19.9373487, 3);
//        $request = new Request('GET', 'http://ip.jsontest.com/');
//        $resposne = $restClient->send($request);


        return new JsonResponse($expectedResponseBody, JsonResponse::HTTP_OK);
    }
}
