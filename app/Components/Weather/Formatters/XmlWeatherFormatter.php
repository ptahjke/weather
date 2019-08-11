<?php

namespace App\Components\Weather\Formatters;

use Spatie\ArrayToXml\ArrayToXml;

class XmlWeatherFormatter extends BaseWeatherFormatter
{
    const FORMAT = 'xml';

    public function getFileContent()
    {
        $result = ['weather' => []];

        foreach ($this->providerResponse->getData() as $rowData) {
            $result['weather']['data'][] = [
                'date'           => $rowData->getDate(),
                'temperature'    => $rowData->getTemperature(),
                'wind_direction' => $rowData->getWindDirection(),
                'wind_speed'     => $rowData->getWindSpeed(),
                'city'           => $rowData->getCity(),
            ];
        }

        return ArrayToXml::convert($result);
    }

    public function getFileContentHeaders()
    {
        return [
            'Content-type'        => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $this->getFileName() . '"'
        ];
    }
}
