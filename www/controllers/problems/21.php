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
    $limit = 10000;
    $amicable_pairs = array();

    for($i = 1; $i < $limit; $i++) {
        // Find divisors
        $divisors = getDivisors($i, true);

        // Sum divisors
        $divisors_sum = array_sum($divisors);

        // Skip if the number is perfect
        if($divisors_sum == $i) {
            continue;
        }

        // Calculate divisors for sum
        $secondary = getDivisors($divisors_sum, true);

        // Calulate sum for secondary divisors
        $secondary_sum = array_sum($secondary);

        // Check if the match is amicable
        if($secondary_sum == $i) {
            $amicable_pairs[$i] = $secondary_sum;
        }
    }

    // Calculate answer
    $answer = array_sum($amicable_pairs);
    
    // Display form
    require_once (VIEW_ROOT.'/problems/21.php');
}