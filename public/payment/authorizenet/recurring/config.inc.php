<?php
    // // SANDBOX
    // // d3veloperDNR // P@ssword1
    // define('AUTHNET_LOGIN', '2TYs29jq'); 
    // define('AUTHNET_TRANSKEY', '3zw899C8868DUpp9');

    define('AUTHNET_LOGIN', '39QwR4uty'); 
    define('AUTHNET_TRANSKEY', '6HrJbK553z6vSp5T');

    // define('AUTHNET_LOGIN', '6kNg4L5K');
    // define('AUTHNET_TRANSKEY', '3t6wV82NwVF36j8y');

    // // LIVE Client's
    // chad_clarkin@yahoo.com | Authorize4425!
    //define('AUTHNET_LOGIN', '39QwR4uty'); 
    //define('AUTHNET_TRANSKEY', '4w375D5p2ZA6ZXrQ');
    //define('AUTHNET_TRANSKEY', '3J83m5rBB6V837yt');

    if (!function_exists('curl_init'))
    {
        throw new Exception('CURL PHP extension not installed');
    }

    if (!function_exists('simplexml_load_file'))
    {
        throw new Exception('SimpleXML PHP extension not installed');
    }
?>