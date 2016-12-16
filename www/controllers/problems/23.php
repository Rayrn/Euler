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
    $limit = 28123; // After this point all numbers are the sum of two abundant numbers
    $abundant_numbers = array();

    for($i = 1; $i < $limit; $i++) {
        // Find divisors
        $divisors = getDivisors($i, true);

        // Check if number is abundant
        if(array_sum($divisors) > $i) {
            $abundant_numbers[] = $i;
        }
    }

    $numbers = array_fill(0, $limit, '');

    foreach($abundant_numbers as $index=>$number) {
        foreach($abundant_numbers as $secondary) {
            unset($numbers[$number + $secondary]);
        }

        // Remove base number from list
        unset($abundant_numbers[$index]);
    }

    $answer = array_sum(array_keys($numbers));
    
    // Display form
    require_once (VIEW_ROOT.'/problems/23.php');
}