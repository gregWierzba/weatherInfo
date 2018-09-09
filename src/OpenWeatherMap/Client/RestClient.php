<?php

namespace App\OpenWeatherMap\Client;
use App\Exception\OpenWeatherMapClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\GuzzleException;

class RestClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws OpenWeatherMapClientException
     */
    public function send(Request $request): Response
    {
        try {
            return $this->client->send($request);
        } catch (GuzzleException $exception) {
            throw new OpenWeatherMapClientException($exception->getMessage(), $exception->getCode());
        }
    }
}