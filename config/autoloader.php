<?php

    $autoload = function($class){

        if(preg_match("/Model/", $class)){
            include('models/'."$class.php");
        }else if(preg_match("/Controller/", $class)){
            include('controllers/'."$class.php");
        }else if(!preg_match("/MercadoPago/", $class)){
            include("classes/$class.php");
        }
        
    };

?>