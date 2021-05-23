<?php

class WeatherApi
{
    private $weather_all_data;
    private $city_name;
    private $country;
    const API_KEY_OPEN_WEATHER_MAP = "055fce98ad1747aa2e4774f3bcca2ed9";
    const BASE_URL_WEATHER = "http://api.openweathermap.org/data/2.5/weather?lang=ja&units=metric&q=";
    // const BASE_URL_FORECAST = "http://api.openweathermap.org/data/2.5/forecast?lang=ja&cnt=2&units=metric&q="; // 3時間毎、6時間後までの天気予報取得


    // コンストラクタ
    function __construct($country = "jp", $city_name = "Himeji")
    {
        $this->country = $country;
        $this->city_name = $city_name;
    }
    // ゲッター・セッター
    function getWeaterAllData()
    {
        return $this->weather_all_data;
    }


    /*

      メソッド

    */

    // 内部呼び出し
    function request()
    {
        // リクエスト
        $response_json = file_get_contents(self::BASE_URL_WEATHER . $this->city_name . "," . $this->country . "&appid=" . self::API_KEY_OPEN_WEATHER_MAP);

        $this->weather_all_data = json_decode($response_json, true);
    }


    // 外部呼び出し関数
    public static function requestWeatherApi()
    {

        $weatherApi = new WeatherApi();
        $weatherApi->request();

        /*

          日時取得処理  ※open weater mapの時刻はずれていることがあるため

        */
        $now = new DateTime('now');
        $now_format = $now->format("Y年m月d日 H時i分s秒");


        // データ加工
        $weather_all_data = $weatherApi->getWeaterAllData();
        $weather = $weather_all_data['weather'][0]['description'];
        $temp = round($weather_all_data['main']['temp'], 0); // 小数第一位で四捨五入


        $weather_array = array(
            "now_format" => $now_format,
            "weather" => $weather,
            "temp" => $temp,
        );

        return $weather_array;
    }
}
