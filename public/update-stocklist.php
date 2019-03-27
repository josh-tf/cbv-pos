<?php

// Turn off all error reporting
error_reporting(0);

$url = 'https://new.computerbank.org.au/update-stocklist.php';

ob_start();
include "render-stocklist.php";
$sldata = ob_get_clean();

$data = array('stocklist' => $sldata);

// use key 'http' even if you send the request to https://...

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) { 
print("Unsucessful");
 } else {
print("Success");
}

?>