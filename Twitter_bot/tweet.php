<?php

require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/weather_api.php");
require_once(__DIR__ . "/translation_api.php");

use Abraham\TwitterOAuth\TwitterOAuth;

class TweetBot
{

    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    const TWITTER_API_KEY = "";
    const TWITTER_API_SECRET_KEY = "";
    const TWITTER_ACCESS_TOKEN = "";
    const TWITTER_ACCESS_TOKEN_SECRET ="";



    /*//////////////////////////////////////////////////////
    

      メソッド

    
    *///////////////////////////////////////////////////////

    // コンストラクタ
    public function __construct() {}

    protected function tweet($str) {

        $twitter_OAuth = new TwitterOAuth(self::TWITTER_API_KEY, self::TWITTER_API_SECRET_KEY, self::TWITTER_ACCESS_TOKEN, self::TWITTER_ACCESS_TOKEN_SECRET);

        $twitter_OAuth->post('statuses/update', ['status' => $str]);
        // echo $str;
    }
}


class WeatherTweetBot extends TweetBot
{

    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    private $city_name;
    private $country;



    /*//////////////////////////////////////////////////////
    

      メソッド

    
    *///////////////////////////////////////////////////////
    // コンストラクタ
    public function __construct($city_name, $country)
    {
        $this->city_name = $city_name;
        $this->country = $country;
    }


    //天気予報ツイート用フォーマット化
    private function strFmt($weather_array) {
        $str = ""; // return用

        $fmt = array(
            "\n\n",
            "：",
            "\n",
            "：",
            "\n",
            "：",
            "℃\n",
        );

        for($i = 0; $i < count($fmt); $i ++) {
            $str .= $weather_array[$i] . $fmt[$i];
        }

        return $str;
    }

    // 天気用取得しツイートする(都市名、国名、翻訳有・無)
    public static function nextDayTweet($city_name, $country) {

        $bot = new WeatherTweetBot($city_name, $country);
        
        $api = "055fce98ad1747aa2e4774f3bcca2ed9";
        // $url = "http://api.openweathermap.org/data/2.5/forecast?lang=ja&units=metric&q=";
        $urls = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
        $la = "34.8151";
        $lo = "134.6853";
        $ex = array("current", "minutely", "hourly", "alerts");
        $str = WeatherApi::nextDay($api, $urls, $la, $lo, $ex);

        $bot->tweet($str);

    }

    public static function todayTweet($city_name, $country) {
        $bot = new WeatherTweetBot($city_name, $country);
        
        $api = "";
        $urls = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
        $la = "34.8151";
        $lo = "134.6853";
        $ex = array("current", "minutely", "hourly", "alerts");

        $str = WeatherApi::today($api, $urls, $la, $lo, $ex);

        $bot->tweet($str);

    }
}

// トリガー（都市名, 国名, 翻訳）現状：日本語→英語のみ
// WeatherTweetBot::WeatherTweet("姫路", "jp");


// WeatherTweetBot::nextDayTweet("姫路", "jp"); // 翌日天気

