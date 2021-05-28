<?php

class WeatherFormat
{
    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    const WEEK = array("日", "月", "火", "水", "木", "金", "土");

    private $str;
    private $title = "兵庫県姫路市の天気予報です。\n\n";
    private $weather = "天気　　： ";
    private $temp_min = "最低気温： ";
    private $temp_max = "最高気温： ";
    private $humidity = "湿度　　： ";
    private $clouds = "雲量　　： ";
    private $pop = "降水確率： ";
    // private $week = array("日", "月", "火", "水", "木", "金", "土");

    /*//////////////////////////////////////////////////////


      メソッド


    *//////////////////////////////////////////////////////
    public function __construct(){}

    public function getStr()
    {
        return $this->str;
    }

    public function setStr($str)
    {
        $this->str = $str;
    }

    public static function formatDaily(array $weather_array, int $day)
    {
        
        // echo var_dump($weather_array[$day]);
    }

    private static function getDateWeek($time_stamp)
    {
        $date = new DateTime();
        $date->setTimestamp($time_stamp);
        $week_num = (int) date_format($date, 'w');
        $date = $date->format('Y年m月d日');

        $date_format = $date . "（" . self::WEEK[$week_num] . "）";

        return $date_format;
    }
}


?>