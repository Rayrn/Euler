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
 * How many Sundays fell on the first of the month during the twentieth century (1 Jan 1901 to 31 Dec 2000)
 */

if($action == '') {
	$answer = 0;

	$start = strtotime('1901-01-01');
	$end = strtotime('2000-12-31');

	$date = $start;
	do {
		if(date('D', $date) == 'Sun') {
			$answer++;
		}

		$date = strtotime('+1 month', $date);

	} while($date < $end);
    
    // Display form
    require_once (VIEW_ROOT.'/problems/19.php');
}