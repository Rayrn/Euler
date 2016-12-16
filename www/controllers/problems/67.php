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
 * Find the maximum total from top to bottom of the triangle below
 */
// Build Array
$data = fopen(APP_ROOT.'/assets/files/67.txt', 'r');

$pyramid = array();

while($row = fgets($data)) {
	$set = explode(' ', $row);
	$pyramid[] = $set;
}

if($action == '') {
	$dynamic_pyramid = array_reverse($pyramid);

	foreach($dynamic_pyramid as $row=>$set) {
		// Skip first row
		if($row == 0) {
			continue;
		}

		foreach($set as $index=>$number) {
			$base = $number;
			$opt1 = $dynamic_pyramid[$row - 1][$index];
			$opt2 = $dynamic_pyramid[$row - 1][$index+1];

			$dynamic_pyramid[$row][$index] = checkrowmax($base, $opt1, $opt2);
		}
	}
    
    // Display form
    require_once (VIEW_ROOT.'/problems/67.php');
}