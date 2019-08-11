<?php

namespace App\Http\Controllers;

use App\Components\Weather\Formatters\BaseWeatherFormatter;
use App\Components\Weather\Providers\BaseWeatherProvider;
use App\Http\Requests\WeatherDataRequest;

class WeatherController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        return view('weather.index');
    }

    public function data(WeatherDataRequest $request)
    {
        $request->authorize();

        try {
            $provider     = BaseWeatherProvider::getProvider($request->get('provider'));
            $response     = $provider->getResponse();
            $exportFormat = BaseWeatherFormatter::getExportFormat($request->get('format'));
            $exportFormat->setProviderResponse($response);
        } catch (\Exception $ex) {
            return redirect()->route('weather')
                ->withErrors([
                    'app' => $ex->getMessage()
                ]);
        }

        return \Response::make($exportFormat->getFileContent(), 200, $exportFormat->getFileContentHeaders());
    }
}
