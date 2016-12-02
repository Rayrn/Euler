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
 * What is the greatest product of four adjacent numbers in the same direction
 * (up, down, left, right, or diagonally) in the 20×20 grid?
 */


if($action == '') {
	// Create Grid
	$grid = array();
	$grid[] = explode(' ', '08 02 22 97 38 15 00 40 00 75 04 05 07 78 52 12 50 77 91 08');
	$grid[] = explode(' ', '49 49 99 40 17 81 18 57 60 87 17 40 98 43 69 48 04 56 62 00');
	$grid[] = explode(' ', '81 49 31 73 55 79 14 29 93 71 40 67 53 88 30 03 49 13 36 65');
	$grid[] = explode(' ', '52 70 95 23 04 60 11 42 69 24 68 56 01 32 56 71 37 02 36 91');
	$grid[] = explode(' ', '22 31 16 71 51 67 63 89 41 92 36 54 22 40 40 28 66 33 13 80');
	$grid[] = explode(' ', '24 47 32 60 99 03 45 02 44 75 33 53 78 36 84 20 35 17 12 50');
	$grid[] = explode(' ', '32 98 81 28 64 23 67 10 26 38 40 67 59 54 70 66 18 38 64 70');
	$grid[] = explode(' ', '67 26 20 68 02 62 12 20 95 63 94 39 63 08 40 91 66 49 94 21');
	$grid[] = explode(' ', '24 55 58 05 66 73 99 26 97 17 78 78 96 83 14 88 34 89 63 72');
	$grid[] = explode(' ', '21 36 23 09 75 00 76 44 20 45 35 14 00 61 33 97 34 31 33 95');
	$grid[] = explode(' ', '78 17 53 28 22 75 31 67 15 94 03 80 04 62 16 14 09 53 56 92');
	$grid[] = explode(' ', '16 39 05 42 96 35 31 47 55 58 88 24 00 17 54 24 36 29 85 57');
	$grid[] = explode(' ', '86 56 00 48 35 71 89 07 05 44 44 37 44 60 21 58 51 54 17 58');
	$grid[] = explode(' ', '19 80 81 68 05 94 47 69 28 73 92 13 86 52 17 77 04 89 55 40');
	$grid[] = explode(' ', '04 52 08 83 97 35 99 16 07 97 57 32 16 26 26 79 33 27 98 66');
	$grid[] = explode(' ', '88 36 68 87 57 62 20 72 03 46 33 67 46 55 12 32 63 93 53 69');
	$grid[] = explode(' ', '04 42 16 73 38 25 39 11 24 94 72 18 08 46 29 32 40 62 76 36');
	$grid[] = explode(' ', '20 69 36 41 72 30 23 88 34 62 99 69 82 67 59 85 74 04 36 16');
	$grid[] = explode(' ', '20 73 35 29 78 31 90 01 74 31 49 71 48 86 81 16 23 57 05 54');
	$grid[] = explode(' ', '01 70 54 71 83 51 54 69 16 92 33 48 61 43 52 01 89 19 67 48');

	// Setup
	$across = count($grid[0]);
	$down = count($grid);

	$largeSet = array();
	$largeSetTotal = 0;

	// Process each row in turn
	for($i = 0; $i < $down; $i++) {
		// Traverse accross the row
		for($j = 0; $j < $across; $j++) {
			if($j + 3 < $across) {
				// First check the total of the next horizontal set
				$set = array();
				$set[] = $grid[$i][$j];
				$set[] = $grid[$i][$j+1];
				$set[] = $grid[$i][$j+2];
				$set[] = $grid[$i][$j+3];

				$setTotal = array_product($set);

				if($setTotal > $largeSetTotal) {
					$xy = array(
						$i . '-' . $j,
						$i . '-' . ($j + 1),
						$i . '-' . ($j + 2),
						$i . '-' . ($j + 3)
					);

					$largeSet = array('i' => $i, 'j' => $j, 'set' => $set, 'xy' => $xy);
					$largeSetTotal = $setTotal;
				}

				// Now check the diagonal down
				if($i + 3 < $down) {
					$set = array();
					$set[] = $grid[$i][$j];
					$set[] = $grid[$i+1][$j+1];
					$set[] = $grid[$i+2][$j+2];
					$set[] = $grid[$i+3][$j+3];

					$setTotal = array_product($set);

					if($setTotal > $largeSetTotal) {
						$xy = array(
							$i . '-' . $j,
							($i + 1) . '-' . ($j + 1),
							($i + 2) . '-' . ($j + 2),
							($i + 3) . '-' . ($j + 3)
						);
						$largeSet = array('i' => $i, 'j' => $j, 'set' => $set, 'xy' => $xy);
						$largeSetTotal = $setTotal;
					}
				}

				// Now check the diagonal up
				if($i - 3 >= 0) {
					$set = array();
					$set[] = $grid[$i][$j];
					$set[] = $grid[$i-1][$j+1];
					$set[] = $grid[$i-2][$j+2];
					$set[] = $grid[$i-3][$j+3];

					$setTotal = array_product($set);

					if($setTotal > $largeSetTotal) {
						$xy = array(
							$i . '-' . $j,
							($i - 1) . '-' . ($j + 1),
							($i - 2) . '-' . ($j + 2),
							($i - 3) . '-' . ($j + 3)
						);
						$largeSet = array('i' => $i, 'j' => $j, 'set' => $set, 'xy' => $xy);
						$largeSetTotal = $setTotal;
					}
				}
			}

			// Finally check the total of the next vertical down set
			if($i + 3 < $down) {
				$set = array();
				$set[] = $grid[$i][$j];
				$set[] = $grid[$i+1][$j];
				$set[] = $grid[$i+2][$j];
				$set[] = $grid[$i+3][$j];

				$setTotal = array_product($set);

				if($setTotal > $largeSetTotal) {
					$xy = array(
						$i . '-' . $j,
						($i + 1) . '-' . $j,
						($i + 2) . '-' . $j,
						($i + 3) . '-' . $j
					);
					$largeSet = array('i' => $i, 'j' => $j, 'set' => $set, 'xy' => $xy);
					$largeSetTotal = $setTotal;
				}
			}
		} // End J
	} // End I

    // Display form
    require_once (VIEW_ROOT.'/problems/11.php');
}