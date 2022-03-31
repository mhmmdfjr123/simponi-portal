<?php

if (!function_exists('idr')){
    function idr($amount){
        return 'IDR '.number_format($amount, 0, ',', '.');
    }
}