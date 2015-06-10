<?php namespace Libraries;

class Func {
    public static function arrayGet($array, $index, $default = null) {
        //$indexes = explode('.', $index);
        //$return = null;
        if (array_key_exists($index, $array)) {
            return $array[$index];
        } else {
            return $default;
        }
    }
}