<?php

namespace Database\Seeders\Helper;

class DataFormatHelper
{
    public static function formatNumberColumn($Value)
    {
        if (empty($Value)) {
            return  0;
        }
        return $Value;
    }

    public static function formatDateColumn($Value)
    {
        if (empty($Value) || $Value == ' ') {
            return  null;
        }
        return  date('Y-m-d h:m:s', strtotime($Value));
    }
}
