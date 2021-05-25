<?php

class WeatherApi
{

    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    const API_KEY_OPEN_WEATHER_MAP = ""; // 適宜入力
    const BASE_URL_WEATHER = "http://api.openweathermap.org/data/2.5/weather?lang=ja&units=metric&q=";

    private $weather_all_data;
    private $city_name;
    private $country;

    private $city_name_romaji = "Himeji"; // 課題：$city_nameから都市名（ローマ字）もしくは都市IDの取得法
    private $title = "の天気";
    private $date_string = "日時";
    private $weater_string = "天気";
    private $temp_string = "気温";
    


    /*//////////////////////////////////////////////////////


      メソッド


    *//////////////////////////////////////////////////////
    // コンストラクタ
    public function __construct($city_name, $country)
    {
      $this->city_name = $city_name;
      $this->country = $country;
    }

    // ゲッター・セッター
    public function getWeaterAllData()
    {
        return $this->weather_all_data;
    }


    // インスタンス変数に天気情報取得
    private function request()
    {
        $response_json = file_get_contents(self::BASE_URL_WEATHER . $this->city_name_romaji . "," . $this->country . "&appid=" . self::API_KEY_OPEN_WEATHER_MAP);

        $this->weather_all_data = json_decode($response_json, true);
    }


    // 現在の天気取得→配列で返す
    public static function requestWeatherNow($city_name, $country)
    {

        $weatherApi = new WeatherApi($city_name, $country);
        $weatherApi->request();

        // データ加工
        $weather_all_data = $weatherApi->getWeaterAllData();
        $now_format = date('Y年m月d日 H時i分s秒', $weather_all_data['dt']);
        $weather = $weather_all_data['weather'][0]['description'];
        $temp = round($weather_all_data['main']['temp'], 0); // 小数第一位で四捨五入

        $weather_array = array(
            $weatherApi->city_name . $weatherApi->title,
            $weatherApi->date_string,
            $now_format,
            $weatherApi->weater_string,
            $weather,
            $weatherApi->temp_string,
            $temp,
        );

        return $weather_array;
    }
}