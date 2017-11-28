<?php
$bmw = array(
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year" => 2015,
);
$toyota = array(
    "model" => "camry",
    "speed" => 110,
    "doors" => 4,
    "year" => 2014,
);
$opel  = array(
    "model" => "astra",
    "speed"=> 100,
    "doors"=> 3,
    "year"=> 2013,
);
$cars = Array(
    "bmw" => $bmw,
    "toyota" => $toyota,
    "opel" => $opel
);
foreach ($cars as $key => $car) {
    echo "CAR $key<br>";
    echo "{$car["model"]} {$car["speed"]} {$car["doors"]} {$car["year"]}<br>";
}