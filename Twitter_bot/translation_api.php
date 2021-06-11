<?php

//class TranslationApi
// {

//     /*//////////////////////////////////////////////////////
    

//       プロパティ


//     *///////////////////////////////////////////////////////
//     const BASE_URL_TRANSLATION = "https://script.google.com/macros/s/AKfycbxbhevKoMco3fA81aTi9S54HEQzOmF-mB66EntPA2UE_UFOijgfFVYQ7fQ1V7KHYgbizg/exec?text=";
    
//     private $text_array;
//     private $source = "&source=";
//     private $target = "&target=";



//     /*//////////////////////////////////////////////////////
    

//       メソッド
    

//     *///////////////////////////////////////////////////////

//     // コンストラクタ
//     public function __construct($text_array, $source, $target)
//     {
//         $this->text_array = (array) $text_array; // String型でも対応できるようにキャスト
//         $this->source .= $source;
//         $this->target .= $target;
//     }

//     // ゲッター
//     public function getText_array() {
//         return $this->text_array;
//     }


//     // インスタンス変数を翻訳変換する
//     private function request() {
//         for($i = 0; $i < count($this->text_array); $i ++) {
//             $encode_text = urlencode($this->text_array[$i]);
            
//             $url = self::BASE_URL_TRANSLATION . $encode_text . $this->source .$this->target;
            
//             $this->text_array[$i] = file_get_contents($url);
//         }
//     }

    
//     // 翻訳→配列で返す
//     public static function requestTranslation($text_array, $source = "ja", $target = "en") {

//         $translationApi = new TranslationApi($text_array, $source, $target);

//         $translationApi->request();

//         return $translationApi->getText_array();

//     }
// }