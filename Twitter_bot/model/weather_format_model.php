<?php

class WeatherFormat
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    const WEEK = array("日", "月", "火", "水", "木", "金", "土");

    private $str;
    private $title = "の天気予報です。\n\n";
    private $weather = "天気　　： ";
    private $temp_min = "最低気温： ";
    private $temp_max = "最高気温： ";
    private $humidity = "湿度　　： ";
    private $clouds = "雲量　　： ";
    private $pop = "降水確率： ";
    private $texts = array(
        "description" => "天気　　： ",
        // "temp" => "気温　　： ",
        "min" => "最低気温： ",
        "max" => "最高気温： ",
        "humidity" => "湿度　　： ",
        "clouds" => "雲量　　： ",
        "pop" => "降水確率： ",
    );
    // private $week = array("日", "月", "火", "水", "木", "金", "土");

    /*//////////////////////////////////////////////////////


      メソッド


    */ /////////////////////////////////////////////////////
    public function __construct(String $city_name)
    {
        $this->title = $city_name . $this->title;
    }

    public function getStr()
    {
        return $this->str;
    }

    public function setStr($str)
    {
        $this->str = $str;
    }

    public static function formatDaily(array $weather_array, String $city_name, int $day)
    {
        $instans = new self($city_name);

        // 日付フォーマット処理
        $weather_array = $weather_array[$day];
        $time_stamp = $weather_array["dt"];
        $date = $instans->getDateWeek($time_stamp);
        if ($day == 0) {
            $date = "本日" . $date . "\n";
        } else if ($day == 1) {
            $date = "明日" . $date . "\n";
        }

        // 文字列処理
        $weather = $weather_array["weather"][0]["description"];
        $temp_min = $weather_array["temp"]["min"];
        $temp_max = $weather_array["temp"]["max"];
        $humidity = $weather_array["humidity"];
        $clouds = $weather_array["clouds"];
        $pop = $weather_array["pop"];

        $temp_min = round($temp_min, 0);
        $temp_max = round($temp_max, 0);
        $pop = $pop * 100;

        $instans->weather .= $weather . "\n";
        $instans->temp_min .= $temp_min . "℃\n";
        $instans->temp_max .= $temp_max . "℃\n";
        $instans->humidity .= $humidity . "％\n";
        $instans->clouds .= $clouds . "％\n";
        $instans->pop .= $pop . "％\n";
        $tag = "#姫路 #天気";
        // $keys = array_keys($instans->texts);
        // $count = count($keys);
        // foreach ($weather_array as $key => $val) {
        //     for ($i = 0; $i < $count; $i++) {
        //         if ($key == $keys[$i]) {
        //             $instans->texts[$key] .= $val;
        //         }
        //     }
        // }

        $instans->str = $date .  $instans->title . $instans->weather . $instans->temp_min . $instans->temp_max . $instans->humidity . $instans->clouds . $instans->pop . $tag;
        echo $instans->str;
    }

    private function getDateWeek($time_stamp)
    {
        $date = new DateTime();
        $date->setTimestamp($time_stamp);
        $week_num = (int) date_format($date, 'w');
        $date = $date->format('Y年m月d日');

        $date_format = $date . "（" . self::WEEK[$week_num] . "）";

        return $date_format;
    }
}
