<?php

class Manager
{

    private $keys;


    // コンストラクタ
    function __construct($keys)
    {
        $this->keys = $keys;
    }

    // ゲッター・セッター
    function getKeys()
    {
        return $this->keys;
    }
    function setKeys($keys)
    {
        $this->keys = $keys;
    }

    // メソッド
    function get_api()
    {
    }


    // public static function getInstance($keys)
    // {

    //     static $instance;
    //     if (!$instance) {
    //         $instance = new self;
    //     }

    //     self::$key = $keys;
    // }

    // protected function
}


function authentication($instance)
{
}
