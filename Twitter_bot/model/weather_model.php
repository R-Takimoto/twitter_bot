<?php

class Weather
{
    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    protected $api_key;
    protected $url;

    /*//////////////////////////////////////////////////////


      メソッド


    *//////////////////////////////////////////////////////
    // コンストラクタ
    public function __construct(){}

    // ゲッター・セッター
    public function getApiKey()
    {
        return $this->api_key;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setApiKey(String $api_key)
    {
        $this->api_key = $api_key;
    }

    public function setUrl(String $url)
    {
        $this->url = $url;
    }

    // データ取得
    protected function request()
    {
        $response_json = file_get_contents($this->url);

        $weather_data = json_decode($response_json, true);

        return $weather_data;
    }

}

?>