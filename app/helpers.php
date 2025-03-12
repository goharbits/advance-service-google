<?php
// use Auth;
function initials($title){
$initials = '';
    $words = explode(' ', $title);

    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return $initials;
}