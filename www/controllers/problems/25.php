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
 * What is the index of the first term in the Fibonacci sequence to contain 1000 digits?
 */

if($action == '') {
	// Print sequence
	$a = 0;
	$b = 1;

	$answer = fibonacci($a, $b, 90);

    // Display form
    require_once (VIEW_ROOT.'/problems/25.php');
}

function fibonacci(&$a, &$b, $cap = 0, $preserve_original_values = false) {
	// Check validity
	if($a < 0 || $b < 0) {
		return false;
	}

	// Initiate
	$a0 = $a;
	$b0 = $b;
	$c = 0;

	// Run sequence
	do {
		// Sum numbers
		$c = $a + $b;

		// Update values for next iteration
		$a = $b;
		$b = $c;
	} while($c < $cap);

	// If we've been told to preseve reset when we have the answer
	if($preserve_original_values) {
		$a = $a0;
		$b = $b0;
	}

	// Return answer
	return $c;
}