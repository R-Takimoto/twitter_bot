<?php

use Abraham\TwitterOAuth\TwitterOAuth;

class TweetBot
{

    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    private $api_key;
    private $api_secret_key;
    private $access_token;
    private $access_token_secret;



    /*//////////////////////////////////////////////////////


      メソッド


    */ //////////////////////////////////////////////////////

    public function __construct()
    {
    }

    public function getApiKey()
    {
        return $this->api_key;
    }

    public function getApiSecretKey()
    {
        return $this->api_secret_key;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getAccessTokenSecret()
    {
        return $this->access_token_secret;
    }

    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    public function setApiSecretkey($api_secret_key)
    {
        $this->api_secret_key = $api_secret_key;
    }

    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    public function setAccessTokenSecret($access_token_secret)
    {
        $this->access_token_secret;
    }

    protected function tweet($str)
    {

        // $twitter_OAuth = new TwitterOAuth($this->api_key, $this->api_secret_key, $this->access_token, $this->access_token_secret);

        // $twitter_OAuth->post('statuses/update', ['status' => $str]);
        echo $str;
    }
}
