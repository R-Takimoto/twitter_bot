<?php







class WeatherApi
{

    /*//////////////////////////////////////////////////////
    

      プロパティ


    *///////////////////////////////////////////////////////
    const API_KEY_OPEN_WEATHER_MAP = "";
    const BASE_URL_WEATHER = "http://api.openweathermap.org/data/2.5/weather?lang=ja&units=metric&q="; // 現在の天気
    //const BASE_URL_FORECAST = "http://api.openweathermap.org/data/2.5/forecast?lang=ja&units=metric&q="; // 3時間毎5日分予報


    // "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric&lat=34.8275713974895&lon=134.68984463882614&appid=

    // private $weather_all_data;
    private $api_key = "&appid=";
    private $base_url;
    private $lat = "&lat=";
    private $lon = "&lon=";
    private $exclude = "&exclude=";
    private $ex = array("current", "minutely", "hourly", "daily", "alerts");
    private $city_name;
    private $country;

    private $city_name_romaji = "Himeji"; // 課題：$city_nameから都市名（ローマ字）もしくは都市IDの取得法
    private $title = "の天気予報";
    private $date_string = "日時";
    private $weater_string = "天気";
    private $temp_string = "気温";
    private $week = array("日", "月", "火", "水", "木", "金", "土");
    


    /*//////////////////////////////////////////////////////


      メソッド


    *//////////////////////////////////////////////////////
    // コンストラクタ
    // public function __construct($city_name, $country)
    // {
    //   $this->city_name = $city_name;
    //   $this->country = $country;
    // }

    public function __construct() {}

    // ゲッター・セッター
    public function getWeaterAllData()
    {
        return $this->weather_all_data;
    }

    public function setApiKey($api_key) {
        $this->api_key .= $api_key;
    }

    public function setBaseUrl($base_url) {
        $this->base_url = $base_url;
    }

    public function setCityName($city_name) {
        $this->city_name = $city_name;
    }

    public function setCountry() {
        $this->country;
    }

    public function setLat($lat) {
        $this->lat .= $lat;
    }

    public function setLon($lon) {
        $this->lon .= $lon;
    }

    public function setExclude($exclude) {
        $this->exclude .= $exclude;
        // $array = (array) $exclude;
        // for($i = 0; $i < count($array); $i ++) {
        //     $this->exclude .= $exclude[$i];
        // }
    }


    // インスタンス変数に天気情報取得
    // private function request()
    // {
    //     $response_json = file_get_contents(self::BASE_URL_WEATHER . $this->city_name_romaji . "," . $this->country . "&appid=" . self::API_KEY_OPEN_WEATHER_MAP);

    //     $this->weather_all_data = json_decode($response_json, true);
    // }

    private function request($url)
    {
        // $response_json = file_get_contents($this->base_url . $this->city_name_romaji . "," . $this->country . "&appid=" . $this->api_key);

        // "https://api.openweathermap.org/data/2.5/onecall?lang=ja&units=metric&lat=  34.8275713974895  &lon=  134.68984463882614  &appid=
        $response_json = file_get_contents($url);

        $weather_all_data = json_decode($response_json, true);

        return $weather_all_data;
    }


    // // 現在の天気取得→配列で返す
    // public static function requestWeatherNow($city_name, $country)
    // {

    //     $weatherApi = new WeatherApi($city_name, $country);
    //     $weatherApi->request();

    //     // データ加工
    //     $weather_all_data = $weatherApi->getWeaterAllData();
    //     $now_format = date('Y年m月d日 H時i分s秒', $weather_all_data['dt']);
    //     $weather = $weather_all_data['weather'][0]['description'];
    //     $temp = round($weather_all_data['main']['temp'], 0); // 小数第一位で四捨五入

    //     $weather_array = array(
    //         $weatherApi->city_name . $weatherApi->title,
    //         $weatherApi->date_string,
    //         $now_format,
    //         $weatherApi->weater_string,
    //         $weather,
    //         $weatherApi->temp_string,
    //         $temp,
    //     );

    //     return $weather_array;
    // }

    // // 3時間毎の天気予報を取得
    // public static function requestWeatherForecast($city_name, $country) {
    //     $weatherApi = new WeatherApi($city_name, $country);
    //     $weatherApi->request();
    // }

    // 3時間毎の天気予報を取得
    public static function nextDay($api_key, $base_url, $lat, $lon, $exclude = array()) {
        $weatherApi = new self;

        $weatherApi->setApiKey($api_key);
        $weatherApi->setBaseUrl($base_url);
        $weatherApi->setLat($lat);
        $weatherApi->setLon($lon);
        $exclude = (array) $exclude;
        // if(0 < count($exclude)) {
        //     // $array = (array) $exclude;
        //     for($i = 0; $i < count($exclude); $i ++) {
        //         if($i != 0) {
        //             $weatherApi->setExclude(",");
        //         }
        //         $weatherApi->setExclude($exclude[$i]);
        //     }
        // }
        for($i = 0; $i < count($exclude); $i ++) {
            if($i != 0) {
                $weatherApi->setExclude(",");
            }
            $weatherApi->setExclude($exclude[$i]);
        }

        //echo var_dump($weatherApi->exclude);
        $url = $weatherApi->base_url . $weatherApi->lat . $weatherApi->lon . $weatherApi->exclude . $weatherApi->api_key;

        $weather_data = $weatherApi->request($url);
        $next_date_time = new DateTime('+1 day');
        $week_num = (int) date_format($next_date_time, 'w');

        // echo $next_date_time->format('Y年m月d日') . "(" . $weatherApi->week[$week_num] . ")";
        $next_day =  "明日" . $next_date_time->format('Y年m月d日') . "（" . $weatherApi->week[$week_num] . "）";
        $weather = "天気　　： " . $weather_data['daily'][1]['weather'][0]['description'];
        $temp_min = "最低気温： " . round($weather_data['daily'][1]['temp']['min'], 0) . "℃";
        $temp_max = "最高気温： " . round($weather_data['daily'][1]['temp']['max'], 0) . "℃";
        $humidity = "湿度　　： " . $weather_data['daily'][1]['humidity'] . "％";
        $clouds = "雲量　　： " .  $weather_data['daily'][1]['clouds'] . "％";
        $conversion_percentage = 100;
        $conversion_pop = $conversion_percentage * $weather_data['daily'][1]['pop'];
        $pop = "降水確率： " . $conversion_pop . "％";


        $str = $next_day . "\n兵庫県姫路市の天気予報です。\n\n" . $weather . "\n" . $temp_min . "\n" . $temp_max . "\n" . $humidity . "\n" . $clouds . "\n" . $pop . "\n\n" . "#姫路 #天気";

        // echo $str;
        return $str;
        
        // echo var_dump($weather_data["daily"][1]);

    }

    public static function today($api_key, $base_url, $lat, $lon, $exclude = array()) {
        $weatherApi = new self;

        $weatherApi->setApiKey($api_key);
        $weatherApi->setBaseUrl($base_url);
        $weatherApi->setLat($lat);
        $weatherApi->setLon($lon);
        $exclude = (array) $exclude;
        // if(0 < count($exclude)) {
        //     // $array = (array) $exclude;
        //     for($i = 0; $i < count($exclude); $i ++) {
        //         if($i != 0) {
        //             $weatherApi->setExclude(",");
        //         }
        //         $weatherApi->setExclude($exclude[$i]);
        //     }
        // }
        for($i = 0; $i < count($exclude); $i ++) {
            if($i != 0) {
                $weatherApi->setExclude(",");
            }
            $weatherApi->setExclude($exclude[$i]);
        }

        //echo var_dump($weatherApi->exclude);
        $url = $weatherApi->base_url . $weatherApi->lat . $weatherApi->lon . $weatherApi->exclude . $weatherApi->api_key;

        $weather_data = $weatherApi->request($url);
        $next_date_time = new DateTime('now');
        $week_num = (int) date_format($next_date_time, 'w');

        // echo $next_date_time->format('Y年m月d日') . "(" . $weatherApi->week[$week_num] . ")";
        $next_day =  "本日" . $next_date_time->format('Y年m月d日') . "（" . $weatherApi->week[$week_num] . "）";
        $weather = "天気　　： " . $weather_data['daily'][0]['weather'][0]['description'];
        $temp_min = "最低気温： " . round($weather_data['daily'][0]['temp']['min'], 0) . "℃";
        $temp_max = "最高気温： " . round($weather_data['daily'][0]['temp']['max'], 0) . "℃";
        $humidity = "湿度　　： " . $weather_data['daily'][0]['humidity'] . "％";
        $clouds = "雲量　　： " .  $weather_data['daily'][0]['clouds'] . "％";
        $conversion_percentage = 100;
        $conversion_pop = $conversion_percentage * $weather_data['daily'][0]['pop'];
        $pop = "降水確率： " . $conversion_pop . "％";

        // echo var_dump($weather_data['daily'][0]);

        $str = $next_day . "\n兵庫県姫路市の天気予報です。\n\n" . $weather . "\n" . $temp_min . "\n" . $temp_max . "\n" . $humidity . "\n" . $clouds . "\n" . $pop . "\n\n" . "#姫路 #天気";

        // echo $str;
        return $str;
        
       

    }
}

