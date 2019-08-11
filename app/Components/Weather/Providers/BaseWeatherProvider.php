<?php

namespace App\Components\Weather\Providers;

use App\Components\Weather\Providers\Exceptions\WrongWeatherProvider;
use App\Components\Weather\Providers\Interfaces\WeatherProviderInterface;
use App\Components\Weather\Providers\Response\WeatherProviderResponse;
use GuzzleHttp\Client;

/**
 * @property Client $httpClient
 * @property WeatherProviderResponse $response
 */
abstract class BaseWeatherProvider
{
    const PROVIDER_WEATHERBIT = 'weatherbit';

    const EXAMPLE_CITY = 'Sevastopol';

    protected $httpClient;
    protected $response;

    private static $providers = [
        self::PROVIDER_WEATHERBIT => 'App\Components\Weather\Providers\WeatherbitProvider'
    ];

    public function __construct()
    {
        $this->httpClient = new Client;
        $this->response   = new WeatherProviderResponse;
    }

    public static function getSelectProviders():array
    {
        return [
            self::PROVIDER_WEATHERBIT => 'weatherbit.io'
        ];
    }

    public static function getInRuleProviders():string
    {
        return implode(',', self::getProviders());
    }

    private static function getProviders():array
    {
        return [
            self::PROVIDER_WEATHERBIT
        ];
    }

    public static function getProvider(string $provider): WeatherProviderInterface
    {
        if (isset(self::$providers[$provider])) {
            return new self::$providers[$provider]();
        }

        throw new WrongWeatherProvider('Wrong provider');
    }
}
