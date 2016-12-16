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
 * If all the numbers from 1 to 1000 (one thousand) inclusive were written out in words, how many letters would be used?
 */
if($action == '') {
	// Init
	$i = 1;
	$letter_count = 0;

	do {
		$number = convert_number_to_words($i, 'US');

		// Remove hypens and spaces
		$number = str_replace(' ', '', $number);
		$number = str_replace('-', '', $number);

		$letter_count += strlen($number);

		$i++;
	} while ($i <= 1000);
    
    // Display form
    require_once (VIEW_ROOT.'/problems/17.php');
}