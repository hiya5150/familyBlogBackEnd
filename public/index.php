<?php


// sets return type in header
header('Content-type: application/json');
// gets an associate array of all headers in the http request
$GLOBALS['headers'] = apache_request_headers();
// includes all required libraries for the api
require_once '../app/bootstrap.php';
//init core library
$init = new Core();
// unset global variables
unset($GLOBALS);