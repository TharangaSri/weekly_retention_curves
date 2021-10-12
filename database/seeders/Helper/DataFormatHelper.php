<?php

namespace Database\Seeders\Helper;

class DataFormatHelper
{
    public static function formatNumberColumn($value)
    {
        if (empty($value)) {
            return  0;
        }
        return $value;
    }

    public static function formatDateColumn($value)
    {
        if (empty($value) || $value == ' ') {
            return  null;
        }
        return  date('Y-m-d h:m:s', strtotime($value));
    }
}
