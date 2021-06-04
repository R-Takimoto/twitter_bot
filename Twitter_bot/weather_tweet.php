<?php
require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/model/weather_cordinate_model.php");
require_once(__DIR__ . "/model/weather_format_model.php");
require_once(__DIR__ . "/model/tweetBot_weather_model.php");



$api = "";
$la = "34.8151";
$lo = "134.6853";
$city_name = "姫路市";
$text_tweet = "";




$time = intval(date('H'));


if($time <= 17) { // 17時以前なら当日の紫外線予報
    $weather_array = WeatherCordinate::getWeather($la, $lo, "hourly", $api);
    $off_set = 0; // 0 = 現在時刻
    $fetch = 3; //3時間分
    
    $text_tweet = WeatherFormat::formatHourly($weather_array, $city_name, $off_set, $fetch);

}else if(17 <= $time) { // 17時以降なら明日の天気予報

    $weather_array = WeatherCordinate::getWeather($la, $lo, "daily", $api);
    $day = 1; // 0 = 当日, 1 = 翌日

    $text_tweet = WeatherFormat::formatDaily($weather_array, $city_name, $day);
}


/*//////////////////////////////////////////////////////


  ツイート

  
*///////////////////////////////////////////////////////

$api_key_twitter = "";
$api_secret_key = "";
$access_token = "";
$access_token_secret = "";
TweetBotWeather::weatherTweet($api_key_twitter, $api_secret_key, $access_token, $access_token_secret, $text_tweet);
