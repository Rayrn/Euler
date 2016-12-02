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


if($action == '') {
	// Fetch list of all files
	$dir_contents = array_diff(scandir(CONTROL_ROOT.'/problems'), array('..', '.'));

	// Convert into a formatted list
	$problems = array();
	foreach($dir_contents as $file) {
		// Fetch full file details
		$problems[] = pathinfo($file);
	}

    // Display form
    require_once (VIEW_ROOT.'/problem_list.php');
}