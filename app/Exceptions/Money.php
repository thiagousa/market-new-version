<?php

namespace App\Exceptions;

class Money
{
    /**
     * Convert double or float values to currency format
     * @param $value
     * @param $decimals
     * @param $decimalSymbol
     * @param $thousandSymbol
     * @return string
     */
    public static function convertDatabaseToView($value, $decimals, $decimalSymbol, $thousandSymbol)
    {
        return number_format($value, $decimals, $decimalSymbol, $thousandSymbol);
    }

    /**
     * Convert currency format to double or float database formats
     * @param $value
     * @return mixed
     */
    public static function convertViewToDatabase($value, $currency = 'USD')
    {
        if($currency == 'BRL'){
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        $value = str_replace(' ', '', $value);
        $value = str_replace('R$', '', $value);
        $value = str_replace('$', '', $value);
        $value = str_replace('US', '', $value);
        $value = str_replace('US$', '', $value);
        $value = str_replace('USD', '', $value);
        $value = str_replace('BRL', '', $value);
        $value = str_replace(',', '', $value);

        return $value;
    }
}