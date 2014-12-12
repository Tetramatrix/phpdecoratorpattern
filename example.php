<?php
/*
*      Copyright (c) 2014 Chi Hoang 
*      All rights reserved
*/
require_once("vehicle.php");

$car=new Vehicle\Vehicle("car");
$car=new Vehicle\AddEngine($car,true);
$car=new Vehicle\AddWheels($car,"4");
echo $car->travel(new Vehicle\Subject("Drive"));
echo $car->travel(new Vehicle\Subject("Arrived"));
echo $car->travel(new Vehicle\Subject());
$test=new Vehicle\Subject();

$bicycle=new Vehicle\Vehicle("bicycle");
$bicycle=new Vehicle\AddWheels($bicycle,"2");
echo $bicycle->travel(new Vehicle\Subject("Drive"));
echo $bicycle->travel(new Vehicle\Subject("Arrived"));
echo $bicycle->travel(new Vehicle\Subject());

$motocycle=new Vehicle\Vehicle("motocycle");
$motocycle=new Vehicle\AddWheels($motocycle,"2");
$motocycle=new Vehicle\AddEngine($motocycle,true);
echo $motocycle->travel(new Vehicle\Subject("Drive"));
echo $motocycle->travel(new Vehicle\Subject("Arrived"));
echo $motocycle->travel(new Vehicle\Subject());
?>