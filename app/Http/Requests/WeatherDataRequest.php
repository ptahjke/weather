<?php

namespace App\Http\Requests;

use App\Components\Weather\Formatters\BaseWeatherFormatter;
use App\Components\Weather\Providers\BaseWeatherProvider;
use Illuminate\Foundation\Http\FormRequest;

class WeatherDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider' => 'required|string|in:' . BaseWeatherProvider::getInRuleProviders(),
            'format'   => 'required|string|in:' . BaseWeatherFormatter::getInRuleFormats()
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw (new \Illuminate\Validation\ValidationException($validator))
            ->errorBag($this->errorBag)->redirectTo(route('weather'));
    }
}
