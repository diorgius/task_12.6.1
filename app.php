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

print_r(getPartsFromFullname($snp));
echo '<br>';
echo getFullnameFromParts($surname, $name, $patronomyc).'<br>';

function getShortName($snp){
    $surname = mb_substr(getPartsFromFullname($snp)['surname'], 0, 1).'.';
    $name = getPartsFromFullname($snp)['name'];
    $short_name = $name.' '.$surname;
    return $short_name;
}

echo getShortName($snp).'<br>';

function getGenderFromName($snp) {
    $gender_мark = 0;
    $surname = getPartsFromFullname($snp)['surname'];
    $name = getPartsFromFullname($snp)['name'];
    $patronomyc = getPartsFromFullname($snp)['patronomyc'];
    if(mb_substr($surname, -2, 2) === 'ва') {
        $gender_мark -= 1;
    } elseif (mb_substr($surname, -1, 1) === 'в') {
        $gender_мark += 1;
    }
    if(mb_substr($name, -1, 1) === 'а') {
        $gender_мark -= 1;
    } elseif(mb_substr($name, -1, 1) === 'й' || mb_substr($name, -1, 1) === 'н') {
        $gender_мark += 1;
    }
    if(mb_substr($patronomyc, -3, 3) === 'вна') {
        $gender_мark -= 1;
    } elseif (mb_substr($patronomyc, -2, 2) === 'ич'){
        $gender_мark += 1;
    }
    return $gender_мark <=> 0;
}

echo getGenderFromName($snp).'<br>';