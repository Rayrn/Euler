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
$pyramid = array();
$pyramid[] = array('75');
$pyramid[] = array('95', '64');
$pyramid[] = array('17', '47', '82');
$pyramid[] = array('18', '35', '87', '10');
$pyramid[] = array('20', '04', '82', '47', '65');
$pyramid[] = array('19', '01', '23', '75', '03', '34');
$pyramid[] = array('88', '02', '77', '73', '07', '63', '67');
$pyramid[] = array('99', '65', '04', '28', '06', '16', '70', '92');
$pyramid[] = array('41', '41', '26', '56', '83', '40', '80', '70', '33');
$pyramid[] = array('41', '48', '72', '33', '47', '32', '37', '16', '94', '29');
$pyramid[] = array('53', '71', '44', '65', '25', '43', '91', '52', '97', '51', '14');
$pyramid[] = array('70', '11', '33', '28', '77', '73', '17', '78', '39', '68', '17', '57');
$pyramid[] = array('91', '71', '52', '38', '17', '14', '91', '43', '58', '50', '27', '29', '48');
$pyramid[] = array('63', '66', '04', '68', '89', '53', '67', '30', '73', '16', '69', '87', '40', '31');
$pyramid[] = array('04', '62', '98', '27', '23', '09', '70', '98', '73', '93', '38', '53', '60', '04', '23');

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
    require_once (VIEW_ROOT.'/problems/18.php');
}