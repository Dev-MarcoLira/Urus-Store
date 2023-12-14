<?php

    $autoload = function($class){

        if(preg_match("/Model/", $class)){
            include('../models/'."$class.php");
        }else if(preg_match("/Controller/", $class)){
            include('controllers/'."$class.php");
        }else{
            include("../classes/$class.php");
        }
        
    };

?>