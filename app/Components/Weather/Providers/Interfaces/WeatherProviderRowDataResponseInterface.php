<?php

namespace App\Components\Weather\Providers\Interfaces;

interface WeatherProviderRowDataResponseInterface
{
    public function setDate(string $value);
    public function getDate();

    public function setTemperature(float $value);
    public function getTemperature();

    public function setWindDirection(string $value);
    public function getWindDirection();

    public function setWindSpeed(float $value);
    public function getWindSpeed();

    public function setCity(string $value);
    public function getCity();
}