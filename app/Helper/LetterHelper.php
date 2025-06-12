<?php

if (!function_exists('generateLetterNumber')) {
    function generateLetterNumber($prefix = 'PL2. UPA BHS', $year = null) {
        $year = $year ?? date('Y');
        
        $lastNumber = session()->get('last_letter_number_' . $year, 0);
        $nextNumber = $lastNumber + 1;
        
        session()->put('last_letter_number_' . $year, $nextNumber);
        
        return sprintf('%03d/%s/%s', $nextNumber, $prefix, $year);
    }
}