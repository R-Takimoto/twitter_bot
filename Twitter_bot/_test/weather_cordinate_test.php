<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../model/weather_cordinate_model.php");
require_once(__DIR__ . "/../model/weather_format_model.php");
require_once(__DIR__ . "/../model/tweetBot_weather_model.php");


$api = "";
$la = "34.8151";
$lo = "134.6853";
$city_name = "姫路市";
$text = "";

$time = intval(date('H'));




if($time <= 17) { // 17時以前なら当日の紫外線予報

    $weather_array = WeatherCordinate::getWeather($la, $lo, "hourly", $api);

    $from_hourly = 0; // 0 = 現在時刻
    $to_hourly = 3; //3時間分
    $text = WeatherFormat::hourlyToTexts($weather_array, $city_name, $from_hourly, $to_hourly);

}else if(17 <= $time) { // 17時以降なら明日の天気予報

    $weather_array = WeatherCordinate::getWeather($la, $lo, "daily", $api);

    $day = 1; // 0 = 当日, 1 = 翌日

    $text = WeatherFormat::dailyToTexts($weather_array, $city_name, $day);
}

echo $text;