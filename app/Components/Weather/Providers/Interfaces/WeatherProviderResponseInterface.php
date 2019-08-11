<?php

namespace App\Components\Weather\Providers\Interfaces;

interface WeatherProviderResponseInterface
{
    public function getData():array;
    public function addRow(WeatherProviderRowDataResponseInterface $row);
}