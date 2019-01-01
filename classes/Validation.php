<?php

class Validation 
{
    public static function required($input)
    {
        $pattern = "/^[_a-z0-9-]+$/i";
        return preg_match($pattern,$input);
    }

    public static function matching($input,$match){
        return $input == $match;
    }
}
