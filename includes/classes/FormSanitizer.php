<?php

class FromSanitizer {

    public static function sanitizeFormString($input){
        $input = strip_tags($input);
        $input = trim($input);
        $input = strtolower($input);
        $input = ucfirst($input);
        return $input;
    }

}


?>