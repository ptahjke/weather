<?php

namespace App\Components\Weather\Formatters;

use App\Components\Weather\Formatters\Interfaces\WeatherFormatterInterface;
use App\Components\Weather\Providers\Exceptions\WrongWeatherFormatter;
use App\Components\Weather\Providers\Interfaces\WeatherProviderResponseInterface;

/**
 * @property WeatherProviderResponseInterface $providerResponse
 */
abstract class BaseWeatherFormatter implements WeatherFormatterInterface
{
    const FILENAME = 'weather';

    protected $providerResponse;

    private static $formatters = [
        XmlWeatherFormatter::FORMAT  => 'App\Components\Weather\Formatters\XmlWeatherFormatter',
        JsonWeatherFormatter::FORMAT => 'App\Components\Weather\Formatters\JsonWeatherFormatter'
    ];

    public static function getSelectFormats()
    {
        return [
            XmlWeatherFormatter::FORMAT  => 'xml',
            JsonWeatherFormatter::FORMAT => 'json',
        ];
    }

    public static function getInRuleFormats()
    {
        return implode(',', self::getFormats());
    }

    private static function getFormats()
    {
        return [
            XmlWeatherFormatter::FORMAT,
            JsonWeatherFormatter::FORMAT
        ];
    }

    public function setProviderResponse(WeatherProviderResponseInterface $providerResponse)
    {
        $this->providerResponse = $providerResponse;
    }

    public static function getExportFormat(string $format): WeatherFormatterInterface
    {
        if (isset(self::$formatters[$format])) {
            return new self::$formatters[$format]();
        }

        throw new WrongWeatherFormatter('Wrong weather formatter');
    }

    public function getFileName()
    {
        return self::FILENAME . ' ' . date('Y-m-d') . '.' . static::FORMAT;
    }
}
