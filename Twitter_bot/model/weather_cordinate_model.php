<?php

require_once(__DIR__ . "/weather_model.php");


class WeatherCordinate extends Weather
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    const EXCLUDE = array(
        "current" => "current,",
        "minutely" => "minutely,",
        "hourly" => "hourly,",
        "daily" => "daily,",
        "alerts" => "alerts,"
    );
    const BASE_URL_WEATHER = "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric";
    private $lat;
    private $lon;

    /*//////////////////////////////////////////////////////


      メソッド


    */ /////////////////////////////////////////////////////
    // ゲッター・セッター
    public function getLat()
    {
        return $this->lat;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function setLat(String $lat)
    {
        $this->lat = $lat;
    }

    public function setLon(String $lon)
    {
        $this->lon = $lon;
    }


    // 天気予報取得(緯度、経度、取得内容、認証鍵)
    public static function getWeather(String $lat, String $lon, String $contents, String $api_key)
    {
        $instans = new self;

        $instans->setLat($lat);
        $instans->setLon($lon);
        $instans->setApiKey($api_key);
        $instans->urlFmt($contents);

        $weather_array = $instans->request();
        $weather_array = $weather_array[$contents];

        return $weather_array;
    }

    // URLを整える
    private function urlFmt(String $contents)
    {

        $lat = "&lat=" . $this->lat;
        $lon = "&lon=" . $this->lon;
        $api_key = "&appid=" . $this->api_key;

        $excludes = self::findExclud($contents);
        $exclude = "&exclude=" . $excludes;

        $this->url = self::BASE_URL_WEATHER . $lat . $lon . $exclude . $api_key;
    }

    // 取得したいデータをパラメータから除外する
    private static function findExclud(String $contents)
    {
        $exclude = self::EXCLUDE;
        $excludes = "";

        foreach ($exclude as $key => $val) {
            if ($contents == $key) {
                continue;
            }
            $excludes .= $val;
        }

        $excludes = rtrim($excludes, ",");

        return $excludes;
    }
}
