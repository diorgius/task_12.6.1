<?php
require 'data.php';
$snp = 'Иванов Иван Иванович';
$surname = 'Иванов';
$name = 'Иван';
$patronomyc = 'Иванович';

// функция разбиения ФИО
function getPartsFromFullname($snp)
{
    $key_array = ['surname', 'name', 'patronomyc'];
    return $snp_array = array_combine($key_array, explode(' ', $snp));
}

print_r(getPartsFromFullname($snp));
echo '<br>';

// функция объединения ФИО
function getFullnameFromParts($surname, $name, $patronomyc)
{
    return $snp = $surname . ' ' . $name . ' ' . $patronomyc;
}

echo getFullnameFromParts($surname, $name, $patronomyc) . '<br>';

// функция сокращения ФИО
function getShortName($snp)
{
    $short_name = getPartsFromFullname($snp)['name'] . ' ' . mb_substr(getPartsFromFullname($snp)['surname'], 0, 1) . '.';
    return $short_name;
}

echo getShortName($snp) . '<br>';

// функция определения пола по ФИО
function getGenderFromName($snp)
{
    $gender_мark = 0;
    $surname = getPartsFromFullname($snp)['surname'];
    $name = getPartsFromFullname($snp)['name'];
    $patronomyc = getPartsFromFullname($snp)['patronomyc'];
    if (mb_substr($surname, -2, 2) === 'ва') {
        $gender_мark -= 1;
    } elseif (mb_substr($surname, -1, 1) === 'в') {
        $gender_мark += 1;
    }
    if (mb_substr($name, -1, 1) === 'а') {
        $gender_мark -= 1;
    } elseif (mb_substr($name, -1, 1) === 'й' || mb_substr($name, -1, 1) === 'н') {
        $gender_мark += 1;
    }
    if (mb_substr($patronomyc, -3, 3) === 'вна') {
        $gender_мark -= 1;
    } elseif (mb_substr($patronomyc, -2, 2) === 'ич') {
        $gender_мark += 1;
    }
    return $gender_мark <=> 0;
}

// функция определения возрастно-полового состава
function getGenderDescription($persons_array)
{
    foreach ($persons_array as $row) {
        foreach ($row as $key => $value) {
            if ($key === 'fullname') $gender[] = getGenderFromName($value);
        }
    }
    $all_men_count = count(array_filter($gender, fn($person) => $person > 0));
    $all_woman_count = count(array_filter($gender, fn($person) => $person < 0));
    $all_man_count = count(array_filter($gender, fn($person) => $person === 0));
    $all_gender_count = count($gender);
    echo '<h4>Гендерный состав аудитории:</h4>';
    echo '----------------------------------------<br>';
    echo 'Мужчиины - ' . round($all_men_count / $all_gender_count * 100, 1) . '%<br>';
    echo 'Женщины - ' . round($all_woman_count / $all_gender_count * 100, 1) . '%<br>';
    echo 'Не удалось определить - ' . round($all_man_count / $all_gender_count * 100, 1) . '%';
}

getGenderDescription($example_persons_array);