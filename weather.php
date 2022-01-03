<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require 'WeatherApi.php';

$city = $argv[1] ?? null;
$weatherApi = new WeatherApi();
echo $weatherApi->getWeatherByCityName($city);