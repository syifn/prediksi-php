<?php

$LuasLahan = $_GET['LuasLahan'];
$JumlahBibit = $_GET['JumlahBibit'];
$JumlahPakan = $_GET['JumlahPakan'];


$res = shell_exec("python3 DTR_predict.py $LuasLahan $JumlahBibit $JumlahPakan");

echo $res;
// var_dump($output);
// var_dump($error);
// var_dump($res);


?>vg