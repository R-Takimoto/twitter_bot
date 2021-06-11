<?php

class WeatherFormat
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    const WEEK = array("日", "月", "火", "水", "木", "金", "土");

    private $tweet_text_;

    private $title_template_ = "の天気予報\n\n";
    private $title_uv_template_ = "の紫外線予報\n\n";

    private $template_texts_ = array(
        "hourly_title" => "◆ ,\n",
        "weather" => "天気　　： ,\n",
        "temp" => "気温　　： ,℃\n",
        "temp_min" => "最低気温： ,℃\n",
        "temp_max" => "最高気温： ,℃\n",
        "humidity" => "湿度　　： ,％\n",
        "clouds" => "雲量　　： ,％\n",
        "pop" => "降水確率： ,％\n",
        "uvi" => "紫外線　： ,\n"
    );


    /*//////////////////////////////////////////////////////


      メソッド


    */ /////////////////////////////////////////////////////
    public function __construct(String $city_name)
    {
        $this->title_template_ = $city_name . $this->title_template_;
        $this->title_uv_template_ = $city_name . $this->title_uv_template_;
    }

    public static function dailyToTexts(array $weather_array, String $city_name, int $day)
    {
        $instans = new self($city_name);
        $weather_array_day = $weather_array[$day];

        /*
        
          見出し処理
        
        */
        $time_stamp = $weather_array_day["dt"];
        $title = $instans->title_template_;
        $header = $instans->createTweetHeader($time_stamp, $title);
        

        /*
        
          ツイートする項目を取得
        
        */
        $weather = $weather_array_day["weather"][0]["description"];
        $temp_min = $weather_array_day["temp"]["min"];
        $temp_max = $weather_array_day["temp"]["max"];
        $humidity = $weather_array_day["humidity"];
        $clouds = $weather_array_day["clouds"];
        $pop = $weather_array_day["pop"];
        $uvi = $weather_array_day["uvi"];

        $temp_min = round($temp_min, 0);
        $temp_max = round($temp_max, 0);
        $pop = $pop * 100;
        $uvi = round($uvi, 0);
        if($uvi == 0) {
            $uvi = 1;
        }

        $texts = array(
            "weather" => $weather,
            "temp_min" => $temp_min,
            "temp_max" => $temp_max,
            "humidity" => $humidity,
            "clouds" => $clouds,
            "pop" => $pop,
            "uvi" => $uvi,
        );

        $instans->createTexts($texts);
        $tag = "\n#姫路 #天気";

        $text_tweet = $header . $instans->tweet_text_ . $tag;
        return $text_tweet;
    }


    public static function hourlyToTexts(array $weather_array, String $city_name, int $start_hourly, int $last_hourly)
    {
        $instans = new self($city_name);

        /*
        
          見出し処理
        
        */
        $time_stamp = $weather_array[$start_hourly]['dt'];
        $title = $instans->title_uv_template_;
        $header = $instans->createTweetHeader($time_stamp, $title);

        /*
        
          時間毎の文字列を作る
        
        */
        for ($start_hourly; $start_hourly <= $last_hourly; $start_hourly++) { 

            $weather_array_hourly = $weather_array[$start_hourly];

            $time_stamp = $weather_array_hourly['dt'];
            $hourly_title = date('H時', $time_stamp);

            // 文字列処理
            $temp = $weather_array_hourly['temp'];
            $clouds = $weather_array_hourly['clouds'];
            $uvi = $weather_array_hourly["uvi"];

            $temp = round($temp, 0);
            $uvi = round($uvi, 0);
            if($uvi == 0) {
                $uvi = 1;
            }

            $texts = array(
                "hourly_title" => $hourly_title,
                "temp" => $temp,
                "clouds" => $clouds,
                "uvi" => $uvi,
            );

            $instans->createTexts($texts);

            if($start_hourly != $last_hourly) {
                $instans->tweet_text_ .= "\n";
            }
        }

        $text_tweet = $header . $instans->tweet_text_;
        return $text_tweet;
    }


    private function createTweetHeader($time_stamp, $title)
    {

        $date = self::getDateWeek($time_stamp);
        $header = $date . $title;

        return $header;
    }


    private static function getDateWeek($time_stamp)
    {
        
        $date = new DateTime();
        
        $today = $date->format('Y年m月d日');
        $tomorrow = $date->modify('+1 day')->format('Y年m月d日');
        $days = array(
            "本日" => $today,
            "明日" => $tomorrow
        );


        $date->setTimestamp($time_stamp);

        // 曜日処理
        $week_num = (int) date_format($date, 'w');
        $day_of_the_week = "（" . self::WEEK[$week_num] . "）";

        $date_f = $date->format('Y年m月d日');


        // 整形
        $flg = true;
        foreach ($days as $key => $val) {
            if($val == $date_f) {
                $date = $key . $date_f . $day_of_the_week;
                $flg = false;
            }
        }
        if($flg) {
            $date = $date_f . $day_of_the_week;
        }

        $date .= "\n";

        return $date;
    }


    private static function findUviComplement($uvi)
    {
        $complement = "";
        if(5 < $uvi) {
            if(7 < $uvi) {
                if(10 < $uvi) {
                    $complement = "（極端に強い）";
                }else {
                    $complement = "（非常に強い）";
                }
            }else {
                $complement = "（強い）";
            }
        }else if(2 < $uvi) {
            $complement = "（中程度）";
        }else {
            $complement = "（弱い）";
        }


        return $complement;
    }

    private function createTexts(array $texts)
    {
        $template = $this->template_texts_;
        
        foreach ($texts as $key => $val) {
            $template_split = preg_split("/[,]/", $template[$key]);
            
            if($key == "uvi") {
                $complement = self::findUviComplement($val);
                $this->tweet_text_ .= $template_split[0] . $val . $complement . $template_split[1];
                continue;
            }
            $this->tweet_text_ .= $template_split[0] . $val . $template_split[1];
        }

    }


}
