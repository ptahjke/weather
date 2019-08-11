<?php

namespace App\Components\Weather\Providers\Response;

use App\Components\Weather\Providers\Interfaces\WeatherProviderResponseInterface;
use App\Components\Weather\Providers\Interfaces\WeatherProviderRowDataResponseInterface;

class WeatherProviderResponse implements WeatherProviderResponseInterface
{
    private $data;

    public function getData():array
    {
        return $this->data;
    }

    public function addRow(WeatherProviderRowDataResponseInterface $row)
    {
        return $this->data[] = $row;
    }
}
