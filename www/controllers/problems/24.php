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
 * What is the millionth lexicographic permutation of the digits 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9?
 */
$numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
natsort($numbers);

if($action == '') {
    // Backup original data
    $numbers_archive = $numbers;

    // Init
    $answer = '';
    $length = count($numbers);
    $limit = 1000000;

    // Set cap
    $cap = $limit > gmp_fact($length) ? $cap = gmp_fact($length) : $limit;
    $remain = $cap - 1;

    // Calculate each digit independantly
    for($i = 1; $i < $length; $i++) {
        $j = (int) ($remain / gmp_fact($length - $i));
        $remain = $remain % gmp_fact($length - $i);
        $answer = "{$answer}{$numbers[$j]}";

        // Remove used iteger
        unset($numbers[$j]);

        // Reindex data
        $numbers = array_values($numbers);

        // Check if we are done
        if($remain == 0) {
            break;
        }
    }

    // Append any remaining numbers to the answer
    for($i = 0; $i < count($numbers); $i++) {
        $answer = "{$answer}{$numbers[$i]}";
    }

    // Display form
    require_once (VIEW_ROOT.'/problems/24.php');
}

function swap($i, $j, &$data) {
    $k = $data[$i];
    $data[$i] = $data[$j];
    $data[$j] = $k;
}