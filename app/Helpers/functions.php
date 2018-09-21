<?php
/**
 * Created by PhpStorm.
 * User: v-thmora
 * Date: 4/12/2018
 * Time: 3:04 PM
 */

function addLosses($value, $value2)
{
    $finalValues = $value += $value2 ;
    return $finalValues;

}


function moneyFormatted($value)
{
    return number_format($value,2,'.',',');
}
