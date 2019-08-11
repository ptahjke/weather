<?php

namespace App\Components\Weather\Formatters;

class JsonWeatherFormatter extends BaseWeatherFormatter
{
    const FORMAT = 'json';

    public function getFileContent()
    {
        $result = [];

        // последовательность колонок так же можно вынести в отдельные сущности
        // реализовать абстрактную фабрику, например
        // но не стал делать, чтобы не выходить за рамки задачи
        foreach ($this->providerResponse->getData() as $rowData) {
            $result[] = [
                'date'           => $rowData->getDate(),
                'wind_speed'     => $rowData->getWindSpeed(),
                'temperature'    => $rowData->getTemperature(),
                'wind_direction' => $rowData->getWindDirection(),
                'city'           => $rowData->getCity(),
            ];
        }

        return json_encode($result);
    }

    public function getFileContentHeaders()
    {
        return [
            'Content-type'        => 'application/json',
            'Content-Disposition' => 'attachment; filename="' . $this->getFileName() . '"'
        ];
    }
}