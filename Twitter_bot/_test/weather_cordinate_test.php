<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../model/weather_cordinate_model.php");
require_once(__DIR__ . "/../model/weather_format_model.php");

spl_autoload_register(function ($name) {
    include __DIR__ . "../model/" . $name . '.php';
});

// String $lat,String $lon,int $day,String $contents,String $api_key


$api = "";
$la = "34.8151";
$lo = "134.6853";
$weather_array = WeatherCordinate::getWeather($la, $lo, "daily", $api);

$city_name = "兵庫県姫路市";
$format = WeatherFormat::formatDaily($weather_array, $city_name, 0);
