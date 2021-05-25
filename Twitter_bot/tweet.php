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
    const TWITTER_API_KEY = "3spECaxPiSm9RyE4UH1aOY7t5";
    const TWITTER_API_SECRET_KEY = "5OcKrBWCSfZVHUoKz78r852Tv96gYyOOW5iNP2PnZVDGY3Mn0I";
    const TWITTER_ACCESS_TOKEN = "1393331878732521473-pgQ0RCOnB4regMP2y4HN5UyhjUASDL";
    const TWITTER_ACCESS_TOKEN_SECRET ="fJ4tHT9K0rmjr61ZzoebbmwhLAcxIHTH2WAI5lI1LBmgS";



    /*//////////////////////////////////////////////////////
    

      メソッド

    
    *///////////////////////////////////////////////////////

    // コンストラクタ
    public function __construct() {}

    protected function tweet($str) {

        $twitter_OAuth = new TwitterOAuth(self::TWITTER_API_KEY, self::TWITTER_API_SECRET_KEY, self::TWITTER_ACCESS_TOKEN, self::TWITTER_ACCESS_TOKEN_SECRET);

        $twitter_OAuth->post('statuses/update', ['status' => $str]);
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
    public static function WeatherTweet($city_name, $country, $translation = false) {

        $bot = new WeatherTweetBot($city_name, $country);
        
        $weather_array = WeatherApi::requestWeatherNow($bot->city_name, $bot->country);
        
        $str = $bot->strFmt($weather_array);
        
        $bot->tweet($str);

        if($translation) {
            $weather_array = TranslationApi::requestTranslation($weather_array);

            $str = $bot->strFmt($weather_array);

            $bot->tweet($str);
        }
    }
}

// トリガー（都市名, 国名, 翻訳）現状：日本語→英語のみ
WeatherTweetBot::WeatherTweet("姫路", "jp", true);
