<?php


function numeroPeso($min, $max, $cont)
{
    $nums = range($min, $max);
    shuffle($nums);

    $aguacates = array();
    for ($i = 0; $i < $cont && $i < count($nums); $i++) {
        array_push($aguacates, $nums[$i]);
    }
    return $aguacates;
}

$aguacates = numeroPeso(80, 480, 30);
$pCatA = 0;
$cntA = 0;
$pCatB = 0;
$cntB = 0;
$pCatC = 0;
$cntC = 0;
$pCatD = 0;
$cntD = 0;

for ($i = 0; $i < 10; $i++) {
    echo "<pre>";
    print_r($aguacates[$i]);
    echo "</pre>";
    if ($aguacates[$i] <= 120) {
        $pCatA = $pCatA + $aguacates[$i];
        $cntA = $cntA + 1;
        $cat = "CATEGORIA A";
        $totalA = array();
        array_push($totalA, $pCatA, $cntA, $cat);
    } elseif (($aguacates[$i] >= 121) && ($aguacates[$i] <= 180)) {
        $pCatB = $pCatB + $aguacates[$i];
        $cntB++;
        $cat = "CATEGORIA B";
        $totalB = array();
        array_push($totalB, $pCatB, $cntB, $cat);
    } elseif (($aguacates[$i] >= 181) && ($aguacates[$i] <= 240)) {
        $pCatC = $pCatC + $aguacates[$i];
        $cntC++;
        $cat = "CATEGORIA C";
        $totalC = array();
        array_push($totalC, $pCatC, $cntC, $cat);
    } elseif (($aguacates[$i] >= 241) && ($aguacates[$i] <= 480)) {
        $pCatD = $pCatD + $aguacates[$i];
        $cntD++;
        $cat = "CATEGORIA D";
        $totalD = array();
        array_push($totalD, $pCatD, $cntD, $cat);
    }
}

echo "<pre>";
print_r($totalA);
echo "</pre>";

echo "<pre>";
print_r($totalB);
echo "</pre>";

echo "<pre>";
print_r($totalC);
echo "</pre>";

echo "<pre>";
print_r($totalD);
echo "</pre>";