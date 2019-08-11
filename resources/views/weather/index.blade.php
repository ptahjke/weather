<?php
use App\Components\Weather\Formatters\BaseWeatherFormatter;
use App\Components\Weather\Providers\BaseWeatherProvider;
?>

@extends('layouts.app')

@section('content')
    {{ Form::open([
        'url'    => route('weather.data'),
        'method' => 'GET',
        'id'     => 'weather-form'
    ]) }}
        @if($errors)
            @foreach($errors->toArray() as $attrErrors)
                @foreach($attrErrors as $error)
                    <div>
                        {{ $error }}
                    </div>
                @endforeach
            @endforeach
        @endif
        <div>
            <label for="provider">Weather Provider:</label>
            {{ Form::select('provider', BaseWeatherProvider::getSelectProviders(), null, ['size' => '1']) }}
        </div>
        <div>
            <label for="format">Format:</label>
            {{ Form::select('format', BaseWeatherFormatter::getSelectFormats(), null, ['size' => '1']) }}
        </div>
        <div>
            {{ Form::submit('Get Data') }}
        </div>

    {{ Form::close() }}
@endsection