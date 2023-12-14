<?php

    class Sanitizer{
    
        public static function sanitizeTextInput($input){
            if(!preg_match_all('/^[A-Za-z\\s]*$/', $input)){
                return false;
            }

            return true;
        }

        public static function validateTextInput($input){
            if(!preg_match_all('/^[a-zA-Z0-9\\s\x{00C0}-\x{00FF}]*$/u', $input)){
                return false;
            }

            return true;
        }

        public static function validateNoNumberTextInput($input){
            if(!preg_match_all('/^[a-zA-Z\\s\x{00C0}-\x{00FF}]*$/u', $input)){
                return false;
            }

            return true;
        }

        public static function sanitizeNoNumberText($input){

            

            return true;
        }

        public static function sanitizeNumberInput($input){

        }

        public static function validateNumberInput($input){
            if(!preg_match_all('/^[0-9]*$/', $input))
                return false;

            return true;
        }

    }


?>