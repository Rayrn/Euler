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
 * Which starting number, under one million, produces the longest chain?
 */

if($action == '') {
    $size = 200;

    $paths = getPermutations($size);

    // Display form
    require_once (VIEW_ROOT.'/problems/15.php');
}

function getPermutations($length) {
    $paths = 1;

    for($i = 0; $i < $length; $i++) {
        $paths *= (2 * $length) - $i;
        $paths /= $i + 1;
    }

    return $paths;
}