<?php

namespace App\OpenWeatherMap;

use App\Exception\OpenWeatherMapClientException;
use App\OpenWeatherMap\Client\RestClient;
use App\OpenWeatherMap\Response\CitiesInCircleResponse;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerInterface;

class NearestCitiesWeatherRepository
{
    /**
     * @var RestClient
     */
    private $restClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $baseHost;

    /**
     * @var string
     */
    private $citiesEndpoint;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(
        RestClient $restClient,
        SerializerInterface $serializer,
        string $baseHost,
        string $citiesEndpoint,
        string $apiKey
    ) {
        $this->restClient = $restClient;
        $this->serializer = $serializer;
        $this->baseHost = $baseHost;
        $this->citiesEndpoint = $citiesEndpoint;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws OpenWeatherMapClientException
     */
    public function getNearestCitiesWeather(float $lat, float $lon, int $limit = 10)
    {
        $queryParams = [
            'lat' => $lat,
            'lon' => $lon,
            'cnt' => $limit,
            'APPID' => $this->apiKey
        ];

        $url = $this->buildUrl($queryParams);
        $request = new Request('GET', $url);
        $response = $this->restClient->send($request);
        $responseObject = $this->serializer->deserialize(
            $response->getBody()->getContents(),
            CitiesInCircleResponse::class,
            'json'
        );
        return $responseObject;
    }

    private function buildUrl($queryParams): string
    {
        return sprintf('%s%s?%s', $this->baseHost, $this->citiesEndpoint, http_build_query($queryParams));
    }
}