<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ExternalApiController extends Controller
{
    public function getExchangeRate()
    {
        $client = new Client(['verify' => false]);

        $response = $client->request('GET', 'https://www.alphavantage.co/query', [
            'query' => [
                'function' => 'TIME_SERIES_DAILY',
                'symbol' => 'IBM',
                'apikey' => 'your-api-key',
            ]
        ]);

        $stockData = json_decode($response->getBody()->getContents());
        return $stockData;
    }

    public function getEconomyData()
    {
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', 'https://api.stlouisfed.org/fred/series/observations', [
            'query' => [
                'series_id' => 'GNPCA',
                'api_key' => 'your-api-key',
                'file_type' => 'json'
            ]
        ]);

        $economicData = json_decode($response->getBody()->getContents());
        return $economicData;
    }
}
