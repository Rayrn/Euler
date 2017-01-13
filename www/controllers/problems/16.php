<?php
/* Registration Form Processing */
if(!defined('APP_ROOT')) {
    exit('No direct script access allowed');
}

// Check if the user is allowed to access this page
if(!$auth_user) {
    header("Location: /");
    exit();
}

//------------------------------------------------------------------
// Action processing
//------------------------------------------------------------------
// Fetch Action
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : $action;


//------------------------------------------------------------------
// Problem processing
//------------------------------------------------------------------
/** Problem details:
 * What is the sum of the digits of the number 2^1000?
 */
if(!extension_loaded('gmp')) {
    $action = 'error';
    $message = 'Sorry, this code requires the GMP extension to be loaded';
}

if($action == '') {
    $base = 2;
    $exponent = 1000;

    $number = gmp_pow($base, $exponent);
    $sum = longAddition(str_split($number));

    // Display form
    require_once (VIEW_ROOT.'/problems/16.php');
}

if($action == 'error') {
    // Display error page
    require_once (VIEW_ROOT.'/error.php');
}