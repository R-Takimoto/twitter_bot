<?php

require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/weather_api.php");

use Abraham\TwitterOAuth\TwitterOAuth;


// twitter認証用APIキー、アクセストークン
define("TWITTER_API_KEY", "3spECaxPiSm9RyE4UH1aOY7t5");
define("TWITTER_API_SECRET_KEY", "5OcKrBWCSfZVHUoKz78r852Tv96gYyOOW5iNP2PnZVDGY3Mn0I");
define("TWITTER_ACCESS_TOKEN", "1393331878732521473-pgQ0RCOnB4regMP2y4HN5UyhjUASDL");
define("TWITTER_ACCESS_TOKEN_SECRET", "fJ4tHT9K0rmjr61ZzoebbmwhLAcxIHTH2WAI5lI1LBmgS");


/*

 つぶやく処理

*/
// インスタンス化
$connetion = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET_KEY, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);

// 日本語
$tweet_ja = $title . "\n\n" . $date_string . "：" . $now_format . "\n" .$weater_string  . "：" . $weater . "\n" . $temp_string . "：" . $temp . "℃";
// つぶやく
$connetion->post('statuses/update', ['status' => $tweet_ja]);

// 英語に変換
$title = $arry_encode_string[0];
$date_string = $arry_encode_string[1];
$weater_string = $arry_encode_string[2];
$temp_string = $arry_encode_string[3];
$weater = $arry_encode_string[4];
$now_format = $now->format("n/d/Y H:i:s");

// // 英語 ※変数の上書きだとTwitterではじかれる
$tweet_en =  $title . "\n\n" . $date_string . "：" . $now_format . "\n" .$weater_string  . "：" . $weater . "\n" . $temp_string . "：" . $temp . "℃";
// つぶやく
$connetion->post('statuses/update', ['status' => $tweet_en]);

?>