<?php

// WeaterOpenMap APIキー、
define("WEATHER_API_KEY", "055fce98ad1747aa2e4774f3bcca2ed9");
define("BASE_URL_WEATER", "http://api.openweathermap.org/data/2.5/weather?lang=ja&units=metric&q=");


// 取得エリアの指定
$city_name = "Himeji";
$country = "jp";

// リクエスト
$response_json = file_get_contents(BASE_URL_WEATER . $city_name . "," . $country. "&appid=" . WEATHER_API_KEY);
$weater_array = json_decode($response_json, true);

/*

   日時取得処理
   ※open weater mapの時刻はずれていることがあるため

*/
$now = new DateTime('now');
$now_format = $now->format("Y年m月d日 H時i分s秒");

// データ加工
// $now = date("Y年m月d日 H時i分s秒", $weater_array['dt']); // 時間にずれがあるので使用しない
$weater = $weater_array['weather'][0]['description'];
$temp = round($weater_array['main']['temp'], 0); // 小数第一位で四捨五入

require_once(__DIR__ . "/translation_api.php");