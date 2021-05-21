<?php

class Manager {

    public static $key = array();

    function __construct() {}

    public static function getInstance($keys) {

        static $instance;
        if(!$instance) {
            $instance = new self;
        }

        self::$key[] = $keys;
        

    }
}



function authentication_run($instance) {
    
}

//$api = "feijddaefw";
//$secret = "dfeigseer";

//$mana = new Manager($api);



?>