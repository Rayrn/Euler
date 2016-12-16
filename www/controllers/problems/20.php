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
 * Find the sum of the digits in the number 100!
 */

if($action == '') {
    // Number to apply solution to
    $request = 100;

    $answer = array_sum(str_split(gmp_fact($request)));
    
    // Display form
    require_once (VIEW_ROOT.'/problems/20.php');
}