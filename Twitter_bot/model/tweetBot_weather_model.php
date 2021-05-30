<?php

class TweetBotWeather extends TweetBot
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    private $city_name;


    /*//////////////////////////////////////////////////////


      メソッド


    */ //////////////////////////////////////////////////////
    // コンストラクタ
    public function __construct()
    {
    }


    // 天気用取得しツイートする(都市名、国名、翻訳有・無)
    // public static function nextDayTweet($city_name)
    // {

    //     $bot = new TweetBotWeather();

    //     $api = "";
    //     $urls = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
    //     $la = "34.8151";
    //     $lo = "134.6853";
    //     $ex = array("current", "minutely", "hourly", "alerts");
    //     $str = WeatherApi::nextDay($api, $urls, $la, $lo, $ex);

    //     $bot->tweet($str);
    // }

    // public static function todayTweet($city_name, $country)
    // {
    //     $bot = new WeatherTweetBot($city_name, $country);

    //     $api = "";
    //     $urls = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
    //     $la = "34.8151";
    //     $lo = "134.6853";
    //     $ex = array("current", "minutely", "hourly", "alerts");

    //     $str = WeatherApi::today($api, $urls, $la, $lo, $ex);

    //     $bot->tweet($str);
    // }
}
