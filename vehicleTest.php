<?php
/*
*      Copyright (c) 2014 Chi Hoang 
*      All rights reserved
*/
require_once '/usr/share/php5/PEAR/PHPUnit/Autoload.php';
require("vehicle.php");

class vehicleTest extends PHPUnit_Framework_TestCase
{
    public function testcarInstanceOf()
    {
        $car=new Vehicle\Vehicle("car");
        $this->assertInstanceOf("Vehicle\Vehicle",$car);  
    }
    
    public function testcarWheels()
    {
        $car=new Vehicle\Vehicle("car");
        $car=new Vehicle\AddWheels($car,"4");
        $this->assertEquals($car->wheels,4);  
    }
    
    public function testcarEngine()
    {
        $car=new Vehicle\Vehicle("car");
        $car=new Vehicle\AddWheels($car,"4");
        $car=new Vehicle\AddEngine($car,true);
        $this->assertEquals($car->engine,true);  
    }
    
    public function testbikeInstanceOf()
    {
        $bike=new Vehicle\Vehicle("bike");
        $this->assertInstanceOf("Vehicle\Vehicle",$bike);  
    }
    
    public function testbikeWheels()
    {
        $bike=new Vehicle\Vehicle("bike");
        $bike=new Vehicle\AddWheels($bike,"4");
        $this->assertEquals($bike->wheels,4);  
    }
    
    public function testbikeEngine()
    {
        $bike=new Vehicle\Vehicle("bike");
        $bike=new Vehicle\AddWheels($bike,"2");
        $this->assertEmpty($bike->engine);  
    }
    
    public function testmbInstanceOf()
    {
        $mb=new Vehicle\Vehicle("mb");
        $this->assertInstanceOf("Vehicle\Vehicle",$mb);  
    }
    
    public function testmbWheels()
    {
        $mb=new Vehicle\Vehicle("mb");
        $mb=new Vehicle\AddWheels($mb,"4");
        $this->assertEquals($mb->wheels,4);  
    }
    
    public function testmbEngine()
    {
        $mb=new Vehicle\Vehicle("mb");
        $mb=new Vehicle\AddWheels($mb,"2");
        $mb=new Vehicle\AddEngine($mb,true);
        $this->assertEquals($mb->engine,true);  
    }
    
    public function testPersonInstanceOf()
    {
        $subject=new Vehicle\Subject("Drive");
        echo $subject;
        $this->expectOutputString('Drive'); 
    }
    
    public function testDrive()
    {
        $mb=new Vehicle\Vehicle("mb");
        $mb=new Vehicle\AddWheels($mb,"2");
        $mb=new Vehicle\AddEngine($mb,true);
        $mb->travel(new Vehicle\Subject("Drive"));
        $this->assertEquals($mb->drive,true);  
    }
    
    public function testArrived()
    {
        $mb=new Vehicle\Vehicle("mb");
        $mb=new Vehicle\AddWheels($mb,"2");
        $mb=new Vehicle\AddEngine($mb,true);
        $mb->travel(new Vehicle\Subject("Drive"));
        $mb->travel(new Vehicle\Subject("Arrived"));
        $this->assertEquals($mb->drive,false);  
    }
    
    public function testDriveNoEngine()
    {
        $mb=new Vehicle\Vehicle("bike");
        $mb=new Vehicle\AddWheels($mb,"2");
        $mb->travel(new Vehicle\Subject("Drive"));
        $this->assertEquals($mb->drive,True);  
    }
}
?>