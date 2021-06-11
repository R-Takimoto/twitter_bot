<?php

use Abraham\TwitterOAuth\TwitterOAuth;

class TweetBot
{

    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    private $api_key_;
    private $api_secret_key_;
    private $access_token_;
    private $access_token_secret_;



    /*//////////////////////////////////////////////////////


      メソッド


    */ //////////////////////////////////////////////////////
    public function __construct($api_key, $api_secret_key, $access_token, $access_token_secret)
    {
        $this->api_key_ = $api_key;
        $this->api_secret_key_ = $api_secret_key;
        $this->access_token_ = $access_token;
        $this->access_token_secret_ = $access_token_secret;
    }


    public function setApiKey($api_key)
    {
        $this->api_key_ = $api_key;
    }

    public function setApiSecretkey($api_secret_key)
    {
        $this->api_secret_key_ = $api_secret_key;
    }

    public function setAccessToken($access_token)
    {
        $this->access_token_ = $access_token;
    }

    public function setAccessTokenSecret($access_token_secret)
    {
        $this->access_token_secret_ = $access_token_secret;
    }


    public static function weatherTweet(
        $api_key,
        $api_secret_key,
        $access_token,
        $access_token_secret,
        $tweet,
        $time) 
    {
        $instans = new self($api_key, $api_secret_key, $access_token, $access_token_secret);

        if($time == 18) {
            $instans->tweetAddToMedia($tweet, $time);
        }else {
            $instans->tweet($tweet, $time);
        }

    }

    
    // テキストのみツイートする
    private function tweet($tweet)
    {

        $Twitter_OAuth = new TwitterOAuth($this->api_key_, $this->api_secret_key_, $this->access_token_, $this->access_token_secret_);
        
        $tweet_fmt = array(
            'status' => $tweet
        );

        // $Twitter_OAuth->post('statuses/update', $tweet_fmt);
    }

    
    private function tweetAddToMedia($tweet, $time) {
        $Twitter_OAuth = new TwitterOAuth($this->api_key_, $this->api_secret_key_, $this->access_token_, $this->access_token_secret_);
        
        $tweet_fmt = array(
            'status' => $tweet
        );

        /*
        
          画像の添付
        
        */
        if(18 == $time) {
            preg_match('/紫外線　： (\w+)/', $tweet , $match);
            $uvi = intval($match[1]);
            $image_str = UvImages::findImage($uvi);

            if($image_str != "") {
                $path = __DIR__ . '/../images/' . $image_str;
                $media_json = $Twitter_OAuth->upload('media/upload', ['media' => $path]);
                $media_param = array('media_ids' => implode(',',[$media_json->media_id_string]));
                $tweet_fmt = array_merge($tweet_fmt, $media_param);
            }
        }

        // $Twitter_OAuth->post('statuses/update', $tweet_fmt);
    }
}
