<?php

class UvImages
{
    /*//////////////////////////////////////////////////////


      プロパティ


    */ //////////////////////////////////////////////////////
    private $images_ = array(
        // "medium" => "",
        "strong" => array("sun_10_giragira.png", "sun_10_beam.png", "sun_10_cream.png", "sun_10_uv_cut.png"),
        "veryStrong" => array("sun_10_giragira.png", "sun_10_beam.png", "sun_10_cream", "sun_10_uv_cut.png"),
        "extremelyStrong" => array("sun_11_gaan.png", "sun_11_gogo.png"),
    );


    /*//////////////////////////////////////////////////////


      メソッド


    */ //////////////////////////////////////////////////////

    public function __construct(){}



    public static function findImage($uvi) {

        $instans = new self();

        $strong = 6;
        $very_strong_num = 8;       
        $extremely_strong_num = 11;


        $image_str = '';
        if($uvi >= $extremely_strong_num) {
            $min = 0;
            $max = 1;
            $rand_num = rand($min, $max);
            $image_str = $instans->images_['extremelyStrong'][$rand_num];
        }else if($uvi >= $very_strong_num){
            $min = 0;
            $max = 3;
            $rand_num = rand($min, $max);
            $image_str = $instans->images_['veryStrong'][$rand_num];
        }else if($uvi >= $strong) {
            $min = 0;
            $max = 3;
            $rand_num = rand($min, $max);
            $image_str = $instans->images_['strong'][$rand_num];
        }

        return $image_str;
    }
}





?>