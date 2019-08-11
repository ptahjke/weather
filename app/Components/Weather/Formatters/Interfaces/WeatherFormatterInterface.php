<?php

namespace App\Components\Weather\Formatters\Interfaces;

use App\Components\Weather\Providers\Interfaces\WeatherProviderResponseInterface;

interface WeatherFormatterInterface
{
    public function setProviderResponse(WeatherProviderResponseInterface $providerResponse);
    public function getFileName();
    public function getFileContent();
    public function getFileContentHeaders();
}