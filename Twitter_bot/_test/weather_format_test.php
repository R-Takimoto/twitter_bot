<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../model/weather_cordinate_model.php");
require_once(__DIR__ . "/../model/weather_format_model.php");
require_once(__DIR__ . "/../model/tweetBot_weather_model.php");


$api = "055fce98ad1747aa2e4774f3bcca2ed9";
$la = "34.8151";
$lo = "134.6853";
$city_name = "姫路市";
$text = "";


$weather_array = WeatherCordinate::getWeather($la, $lo, "hourly", $api);

$to_hourly = 3; //3時間分
$from_hourly = 0; // 0 = 現在時刻
$text = WeatherFormat::formatHourly($weather_array, $city_name, $from_hourly, $to_hourly);


?>