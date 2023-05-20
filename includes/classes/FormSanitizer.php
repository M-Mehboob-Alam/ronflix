<?php

class FromSanitizer {

    public static function sanitizeFormName($input){
        $input = strip_tags($input);
        $input = trim($input);
        $input = strtolower($input);
        $input = ucfirst($input);
        return $input;
    }
    public static function sanitizeFormUsername($input){
        $input = strip_tags($input);
        $input = trim($input);
        $input = strtolower($input);
        return $input;
    }
    public static function sanitizeFormPassword($input){
        $input = strip_tags($input);
        $input = trim($input);
        $input = strtolower($input);
        return $input;
    }
    public static function sanitizeFormEmail($input){
        $input = strip_tags($input);
        $input = trim($input);
        $input = strtolower($input);
        return $input;
    }

}


?>