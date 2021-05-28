<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../model/weather_cordinate_model.php");
require_once(__DIR__ . "/../model/weather_format_model.php");

// String $lat,String $lon,int $day,String $contents,String $api_key


$api = "";
$la = "34.8151";
$lo = "134.6853";
$weather_array = WeatherCordinate::getWeather($la, $lo, "daily", $api);
$format = WeatherFormat::formatDaily($weather_array, 0)

?>