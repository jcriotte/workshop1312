<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConvertPriceService
{
    private HttpClientInterface $client;
    private string $apiKey;
    
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->client = $httpClient;
        $this->apiKey = $_ENV['API_CURRENCY_KEY'];
    }

    public function ConvertPriceEurDol(float $price):float
    {
        // appel à l'API
        $response = $this->client->request(
            'GET', "https://v6.exchangerate-api.com/v6/$this->apiKey/pair/EUR/USD/$price");
        
        // Continuing if we got a result
        if ($response->getStatusCode() === 200) {

            $result = $response->toArray();
            return $result['conversion_result'];
        }
        return 0;
    }

    public function ConvertPriceEurYen(float $price):float
    {
        // appel à l'API
        $response = $this->client->request(
            'GET', "https://v6.exchangerate-api.com/v6/$this->apiKey/pair/EUR/JPY/$price");
        
        // Continuing if we got a result
        if ($response->getStatusCode() === 200) {

            $result = $response->toArray();
            return $result['conversion_result'];
        }
        return 0;
    }
}
