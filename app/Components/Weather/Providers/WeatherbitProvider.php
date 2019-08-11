<?php

namespace App\Components\Weather\Providers;

use App\Components\Weather\Providers\Interfaces\WeatherProviderInterface;
use App\Components\Weather\Providers\Response\WeatherProviderResponse;

class WeatherbitProvider
    extends BaseWeatherProvider
    implements WeatherProviderInterface
{
    private static $apiUrl = 'https://api.weatherbit.io/v2.0/forecast/daily';

    public function getResponse(): WeatherProviderResponse
    {
        $data = $this->getData();

        foreach ($data['data'] as $dailyData) {
            $row = new Response\WeatherProviderRowDataResponse;

            $row->setDate($dailyData['datetime']);
            $row->setTemperature($dailyData['temp']);
            $row->setWindDirection($dailyData['wind_cdir_full']);
            $row->setWindSpeed($dailyData['wind_spd']);
            $row->setCity($data['city_name']);

            $this->response->addRow($row);
        }

        return $this->response;
    }

    private function getData():array
    {
        $response = $this->httpClient->get($this->getUri());

        return json_decode($response->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);
    }

    private function getUri()
    {
        $queryParams = [
            'city' => self::EXAMPLE_CITY,
            'key'  => env('WEATHERBIT_API_KEY'),
        ];

        return self::$apiUrl . '?' . http_build_query($queryParams);
    }
}
