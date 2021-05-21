<?php

/*

   翻訳準備処理

*/
// 翻訳APIのURL
define("BASE_URL_TRANSLATION_FRONT", "https://script.google.com/macros/s/AKfycbxbhevKoMco3fA81aTi9S54HEQzOmF-mB66EntPA2UE_UFOijgfFVYQ7fQ1V7KHYgbizg/exec?text=");
define("BASE_URL_TRANSLATION_BACK", "&source=ja&target=en");
// $url_front = '';

// $url_back = '&source=ja&target=en';


// 翻訳する文字列
$title = "姫路市の天気";
$date_string = "日時";
$weater_string = "天気";
$temp_string = "気温";

$arry_encode_string = array(
    $title,
    $date_string,
    $weater_string,
    $temp_string,
    $weater
);


/*

   エンコード、翻訳処理

*/
for ($i = 0; $i < count($arry_encode_string); $i ++) {
    // エンコード
    $encode = urlencode($arry_encode_string[$i]);

    $url = BASE_URL_TRANSLATION_FRONT . $encode . BASE_URL_TRANSLATION_BACK;

    // 翻訳
    $arry_encode_string[$i] = file_get_contents($url);
}