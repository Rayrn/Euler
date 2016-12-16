<?php 
/* General purpose function library */
if(!defined('APP_ROOT')) {
    exit('No direct script access allowed');
}

/**
 * Prints each argument passed (no limit on number) as a print_r() output wrapped in pre tags
 * @return void
 */
function print_pre() {
    $args = func_get_args();

    if(!empty($args)) {
        foreach($args as $input) {
            echo "<pre>"; print_r($input); echo "</pre>";
        }
    }
}

/**
 * Find all the primes up to a given number using the seive of Eratosthenes algorythm.
 *
 * @param $finish The number to stop searching for prime numbers.
 * @param integer[] &$predefined (Optional) An array of predefined prime numbers
 * @return array The array of prime numbers.
 */
function find_primes($finish, $predefined = array()) {
    // Check Values
    $predefined = find_primes_init($finish, $predefined);

    // Define Start
    $start = end($predefined);

    // Check if we need to do any more processing
    if($start + 4 > $finish) {
        return $predefined;
    }

    // Initialise the range of numbers.
    $range = range($start + 2, $finish, 2); // Ignore odd numbers
    $primes = array_merge($predefined, $range);
    $primes = array_combine($primes, $primes);

    // Start checking with 3 as even numbers are already filtered out
    $number = 3;

    // Loop through the numbers and remove the multiples from the primes array.
    while (($number * $number) < $finish) {
        // Check where we are starting from
        if($start <= $number) {
            // If the start point is smaller than the prime index then just use the number itself
            $loopstart = $number + $number;
        } else {
            // Skip to the first point in the new $primes array where we find children of this times table
            $loopstart = $start % $number;
            $loopstart = $loopstart == 0 ? $start : ($start - $loopstart + $number);
        }

        // Remove all children in this times table
        for ($i = $loopstart; $i <= $finish; $i += $number) {
            unset($primes[$i]);
        }

        // Fetch next prime
        $number = next($primes);
    }

    // Return result
    return $primes;
}

function find_primes_init($finish, $predefined) {
    // Invalid
    if($finish < 2) {
        return array();
    }

    // Check if we need to calculate anything
    if($finish == 2) {
        return array('2' => 2);
    }

    // Set up inital variables
    $predefined['2'] = 2;
    $predefined['3'] = 3;

    /**
     * Set Cap/Split & calculate Iterations
     *  FYI the highest efficiency gain will be found by pushing php up to the borders of
     *  its memory limit rather than by setting a desired number of iterations and letting it
     *  calculate the minimum split value.
     */
    $limit = 300000;

    // Limit Size to ~3m per run
    if($finish - end($predefined) > ($limit * 1.1)) {
        // Create bucket
        $cap        = $finish; // When to stop looking
        $split      = $limit; // Stop php memory overloading
        $iterations = ceil($cap / $split);

        // Split into buckets
        for($i = 1; $i <= $iterations; $i++) {
            // Check end point
            $local_cap = $split * $i;

            // Check that we haven't exceeded cap (ie cap % split !== 0)
            if($local_cap > $cap) {
                $local_cap = $cap;
            }

            // Lookup primes using Seive of Eratosthenes
            $predefined = find_primes($local_cap, $predefined);
        }
    }

    return($predefined);
}

/**
 * Get the triangle number at position X
 * @param integer $sequence Value to convert
 * @return integer $sequence Converted value
 */
function getTriangle($triangleIndex) {
    return ($triangleIndex * ($triangleIndex + 1)) / 2;
}


/**
 * Get the prime factors for a given number
 * @param integer $number Value to divide
 * @param integer[] &$predefined (Optional) An array of predefined prime numbers
 * @return integer[] $factors Array of factirs
 */
function getPrimeFactors($number, &$predefined = array()) {
    // Invalid
    if($number < 1) {
        return array();
    }

    // Init
    $factors = array();

    // All numbers are divisible by 1
    $factors[1] = 1;

    // Start by finding all prime numbers less than $number
    if(count($predefined) == 0 || end($predefined) < $number) {
        $predefined = find_primes($number, $predefined);
    }

    // Loop through each prime
    foreach($predefined as $prime) {
        if($prime * 2 > $number) {
            break;
        }

        if($number % $prime == 0) {
            $factors[$prime] = $prime;
        }
    }

    return $factors;
}

/**
 * Get the divisors for a given number
 * @param integer $number Value to divide
 * @param boolean $skipSelf Include base number in list?
 * @return integer[] $divisors Array of divisors
 */
function getDivisors($number, $skipSelf = false) {
    // Invalid
    if($number < 1) {
        return array();
    }

    // Init
    $divisors = array();

    $root = sqrt($number);
    
    for ($i = 1; $i <= $root; $i++) {
        if ($number % $i == 0) {
            $divisors[$i] = $i;
            $divisors[$number / $i] = $number / $i;
        }
    }

    // Sort sequentially
    ksort($divisors);

    if($skipSelf) {
        unset($divisors[$number]);
    }

    // Output
    return $divisors;
}

/**
 * Add together a series of numbers using long addition
 * @param int[] $numbers Array of numbers to process
 * @return int sum of $numbers
 */
function longAddition($numbers) {
    if(!is_array($numbers)) {
        return (int) $numbers;
    }

    // Initialise
    $answer = '';
    $remainder = 0;

    // Find longest string
    $lengths = array_map('strlen', $numbers);
    $longest = max($lengths);

    // Pad out all strings to match longest
    foreach($numbers as $index=>$val) {
        $numbers[$index] = str_pad($val, $longest, ' ', STR_PAD_LEFT);
    }


    for($i = ($longest - 1); $i > -1; $i--) {
        // Reset/Init
        $digits = array();
        $digits[] = $remainder;

        // Build Numbers Array
        foreach($numbers as $number) {
            $digits[] = $number[$i];
        }

        // Calculate Sum
        $sum = addSet($digits);

        // Append final digit to string
        $answer = substr($sum, -1) . $answer;

        // Carry over
        $remainder = substr($sum, 0, -1);
    }

    // Trim last digit from remainder
    $remainder = substr($sum, 0, -1);

    // Append final digit to string
    $answer = $remainder . $answer;

    return $answer;
}

/**
 *  Add together a series of numbers and return the results
 * @param int[] $in Array of numbers to process
 * @return int sum of $in
 */
function addSet($in) {
    return is_array($in) ? array_sum($in) : (int) $in;
}

/**
 * Apply the collatz sequence to a number
 * @param integer $in Number to process
 * @return integer[] $sequence full sequence
 */
function collatzFull($in) {
    // Initialise
    $collatz = $in;
    $sequence = array();

    // Record first value
    $sequence[] = $in;

    // Run sequence
    while($collatz > 1) {
        // Apply Rule
        $collatz = $collatz % 2 == 0 ? $collatz / 2 : ($collatz * 3) + 1;

        // Append
        $sequence[] = $collatz;
    }

    return $sequence;
}

/**
 * Apply the collatz sequence to a number 
 * @param integer $in Number to process
 * @return integer[] $sequence Number of iterations in sequence
 */
function collatzCount($in, &$collatz_set = array()) {
    // Initialise
    $collatz = $in;
    $sequence = 1;

    // Run sequence
    while($collatz > 1) {
        // Apply Rule
        $collatz = $collatz & 1 ? $collatz * 3 + 1 : $collatz / 2 ;

        // Check if we already have the data saved
        if(isset($collatz_set[$collatz])) {
            $sequence += $collatz_set[$collatz];
            break;
        }

        // Increment
        $sequence++;
    }

    // Save
    $collatz_set[$in] = $sequence;

    return $sequence;
}

/**
 * Get the number of permutations in a path to a square grid
 * @param integer $length Length of the grid
 * @return integer $permutations Permutations
 */
function getPermutations($length) {
    $permutations = 1;

    for($i = 0; $i < $length; $i++) {
        $permutations *= (2 * $length) - $i;
        $permutations /= $i + 1;
    }

    return $permutations;
}

/**
 * Converts a numeric integer to a string representation, following british naming conventions of course (use of and)
 * Source : http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
 * @param integer $number Number to convert
 * @param string $lang Default UK, opts: US
 * @return string $string Textual representation
 */
function convert_number_to_words($number, $lang = 'UK') {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    // Remove 'U' from fourty
    if($lang == 'US') {
        $dictionary[40] = 'forty';
    }

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number), $lang);
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder, $lang);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits, $lang) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder, $lang);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

/**
 * Return $opt1 > $opt2 ? $base + $opt1 : $base + $opt2
 * @param integer $base Base value
 * @param integer $opt1 Number to check
 * @param integer $opt2 Number to check
 * @return integer greatest value
 */
function checkrowmax($base, $opt1, $opt2) {
    return $opt1 > $opt2 ? $base + $opt1 : $base + $opt2;
}

/**
 * Calculates the letters position in the alphabet (A=1, Z=26);
 * @param string $letter Letter to check
 * @return integer Position
 */
function positionInAlphabet($letter) {
    return ord(strtolower($letter)) - 96;
}