<?php


function brl_money_format(float $number): string
{

    return config('app.currency') . ' ' . str_replace('.00', '', number_format($number, 2));
}


function usd_money_format(float $number): string
{
    return '$' . number_format($number, 2);
}
function usd_money_format_v2(float $number): string
{

    return str_replace('.00', '', number_format($number, 2));
}
