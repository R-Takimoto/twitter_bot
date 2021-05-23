<?php

require_once(__DIR__ . "/weather-model.php");

$weather_array = WeatherApi::requestWeatherApi("jp", "Himeji");

echo $weather_array["weather"];
