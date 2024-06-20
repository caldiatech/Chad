<?php
    // // SANDBOX
    // // smithlad2412 // Smit_lad@007 
    define('AUTHNET_LOGIN', '6kNg4L5K');
    define('AUTHNET_TRANSKEY', '3t6wV82NwVF36j8y');

     // LIVE Client's
    // chad_clarkin@yahoo.com | Authorize4425!
    ///////////////////////////////////////////////
        // define('AUTHNET_LOGIN', '39QwR4uty'); 
        // define('AUTHNET_TRANSKEY', '9xUZK6mk6m9Sw66Y');
    ///////////////////////////////////////////////////////////////////
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