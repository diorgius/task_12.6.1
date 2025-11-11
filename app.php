<?php
$snp = 'Иванов Иван Иванович';
$surname = 'Иванов';
$name = 'Иван';
$patronomyc = 'Иванович';

function getPartsFromFullname($snp) {
    $key_array = ['surname', 'name', 'patronomyc']; 
    return $snp_array = array_combine( $key_array, explode(' ', $snp));
}

function getFullnameFromParts($surname, $name, $patronomyc) {
    return $snp = $surname.' '.$name.' '.$patronomyc;
}

// print_r(getPartsFromFullname($snp));
// print_r(getFullnameFromParts($surname, $name, $patronomyc));

function getShortName($snp){
    $surname = mb_substr(getPartsFromFullname($snp)['surname'], 0, 1).'.';
    $name = getPartsFromFullname($snp)['name'];
    $shortName = $name.' '.$surname;
    return $shortName;
}

print_r(getShortName($snp));