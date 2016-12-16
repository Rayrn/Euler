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
 * Evaluate the sum of all the amicable numbers under 10000
 */

if($action == '') {
    $data = fopen(APP_ROOT.'/assets/files/22.txt', 'r');

    $names = array();
    while($row = fgets($data)) {
        $names = explode(',', str_replace('"', '', $row));
    }
    sort($names);

    $values = array();

    // Calculate the score for each name
    foreach($names as $index=>$name) {
        $human_index = $index + 1;

        // Fetch Value
        $values[] = array_sum(array_map("positionInAlphabet", str_split($name))) * $human_index;
    }

    // Calculate answer
    $answer = array_sum($values);;
    
    // Display form
    require_once (VIEW_ROOT.'/problems/21.php');
}