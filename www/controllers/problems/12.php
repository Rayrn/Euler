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
 * What is the value of the first triangle number to have over five hundred divisors?
 */

if($action == '') {
	//------------------------------------------------------------------
	// Check triangle numbers
	//------------------------------------------------------------------
	// Init
	$triangleIndex = 0;

	// Loop
	do {
		$triangleIndex++;

		$triangle = getTriangle($triangleIndex);
		$divisors = getDivisors($triangle);

	} while(count($divisors) < 500 && $triangleIndex < 12500);

    // Display form
    require_once (VIEW_ROOT.'/problems/12.php');
}