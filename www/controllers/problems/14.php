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
    // Initialise
    $collatz_set = array();

    // Limit of search
    $cap = 1000000;

    // Find min appropriate value
    $start = (int) ($cap / 3 - 1);
    $start = $start & 1 ? $start : $start - 1;

    // Iterate through options
    for($i = 1; $i < $cap; $i += 2) {
        collatzCount($i, $collatz_set);
    }

    // Find longest sequence
    $answer = array_search(max($collatz_set), $collatz_set);
    $anwser_seq = $collatz_set[$answer];

    // Display form
    require_once (VIEW_ROOT.'/problems/14.php');
}