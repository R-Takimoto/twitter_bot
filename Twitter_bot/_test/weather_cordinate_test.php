<?php

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../model/weather_cordinate_model.php");
require_once(__DIR__ . "/../model/weather_format_model.php");
require_once(__DIR__ . "/../model/tweetBot_model.php");
// require_once(__DIR__ . "/../model/tweetBot_weather_model.php");
require_once(__DIR__ . "/../model/uv_images_model.php");


$api = "055fce98ad1747aa2e4774f3bcca2ed9";
$la = "34.8151";
$lo = "134.6853";
$city_name = "姫路市";
$text = "";

$time = intval(date('H'));




if($time < 17) { // 16:59までなら当日の紫外線予報

    $weather_array = WeatherCordinate::getWeather($la, $lo, "hourly", $api);

    $from_hourly = 0; // 0 = 現在時刻
    $to_hourly = 2; //3時間分
    $text = WeatherFormat::hourlyToTexts($weather_array, $city_name, $from_hourly, $to_hourly);

}else if(17 <= $time) { // 17時以降なら明日の天気予報

    $weather_array = WeatherCordinate::getWeather($la, $lo, "daily", $api);

    $day = 1; // 0 = 当日, 1 = 翌日

    $text = WeatherFormat::dailyToTexts($weather_array, $city_name, $day);
}

echo $text;


// $api_key_twitter = "3spECaxPiSm9RyE4UH1aOY7t5";
// $api_secret_key = "5OcKrBWCSfZVHUoKz78r852Tv96gYyOOW5iNP2PnZVDGY3Mn0I";
// $access_token = "1393331878732521473-pgQ0RCOnB4regMP2y4HN5UyhjUASDL";
// $access_token_secret = "fJ4tHT9K0rmjr61ZzoebbmwhLAcxIHTH2WAI5lI1LBmgS";
// TweetBotWeather::weatherTweet($api_key_twitter, $api_secret_key, $access_token, $access_token_secret, $text, $time);