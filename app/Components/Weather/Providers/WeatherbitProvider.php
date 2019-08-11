<?php

namespace App\Components\Weather\Providers;

use App\Components\Weather\Providers\Interfaces\WeatherProviderResponseInterface;
use App\Components\Weather\Providers\Response\WeatherProviderRowDataResponse;

class WeatherbitProvider extends BaseWeatherProvider
{
    // для примера взял наш город
    // и указал прямую апи ссылку (данные за последние 16 дней)
    const EXAMPLE_CITY = 'Sevastopol';

    private static $apiUrl = 'https://api.weatherbit.io/v2.0/forecast/daily';

    public function getResponse(): WeatherProviderResponseInterface
    {
        $data = $this->getData();

        foreach ($data['data'] as $dailyData) {
            $row = new WeatherProviderRowDataResponse;

            $row->setDate((string) ($dailyData['datetime'] ?? ''));
            $row->setTemperature((float) ($dailyData['temp'] ?? ''));
            $row->setWindDirection((string) ($dailyData['wind_cdir_full'] ?? ''));
            $row->setWindSpeed((float) ($dailyData['wind_spd'] ?? ''));
            $row->setCity((string) ($data['city_name'] ?? ''));

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
