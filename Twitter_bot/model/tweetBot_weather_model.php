<?php

require_once(__DIR__ . "/tweetBot_model.php");

class TweetBotWeather extends TweetBot
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    private $url;


    /*//////////////////////////////////////////////////////


      メソッド


    */ //////////////////////////////////////////////////////

    // ゲッター
    public function getUrl()
    {
        return $this->url;
    }

    // セッター
    public function setUrl($url)
    {
        $this->url = $url;
    }


    // 天気用取得しツイートする(都市名、国名、翻訳有・無)
    public static function weatherTweet($api_key, $api_secret_key, $access_token, $access_token_secret, $text_tweet)
    {

        $instans = new self();

        $instans->setApiKey($api_key);
        $instans->setApiSecretkey($api_secret_key);
        $instans->setAccessToken($access_token);
        $instans->setAccessTokenSecret($access_token_secret);

        $instans->tweet($text_tweet);
    }
}
