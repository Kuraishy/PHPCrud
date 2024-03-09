<?php

namespace Framework;

class Validation
{
    /**
     * Validate a string for db
     *
     * @param string $value
     * @param integer $min
     * @param int $max
     * @return bool
     */
    public static function string(string $value, $min = 1, $max = INF): bool
    {

        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
        return false;
    }


    /**
     * Validad emain
     * 
     * @param string $value
     * @return boolean
     */
    public static function email($value): bool
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }


    /**
     * match a value against another
     *
     * @param string $val1
     * @param string $val2
     * @return boolean
     */
    public static function match($val1, $val2): bool
    {
        $val1 = trim($val1);
        $val2 = trim($val2);

        return $val1 === $val2;
    }
}
