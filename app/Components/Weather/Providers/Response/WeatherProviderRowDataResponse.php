<?php

namespace App\Components\Weather\Providers\Response;

use App\Components\Weather\Providers\Interfaces\WeatherProviderRowDataResponseInterface;

class WeatherProviderRowDataResponse implements WeatherProviderRowDataResponseInterface
{
    private $date;
    private $temperature;
    private $windDirection;
    private $windSpeed;

    public function setDate(string $value)
    {
        $this->date = $value;
    }

    public function setTemperature(float $value)
    {
        $this->temperature = $value;
    }

    public function setWindDirection(string $value)
    {
        $this->windDirection = $value;
    }

    public function setWindSpeed(float $value)
    {
        $this->windSpeed = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getWindDirection()
    {
        return $this->windDirection;
    }

    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    public function setCity(string $value)
    {
        $this->city = $value;
    }

    public function getCity()
    {
        return $this->city;
    }
}