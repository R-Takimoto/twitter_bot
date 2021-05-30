<?php
require_once(__DIR__ . "/vendor/autoload.php");
// require_once(__DIR__ . "/model/tweet_model.php");


spl_autoload_register(function ($name) {
    include __DIR__ . "/model/" . $name . '.php';
});

$api = "";
$urls = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
$la = "34.8151";
$lo = "134.6853";



//WeatherTweetBot::todayTweet("兵庫県姫路市", "jp");
