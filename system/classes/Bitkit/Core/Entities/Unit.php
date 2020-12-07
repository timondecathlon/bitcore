<?php

namespace Bitkit\Core\Entities;

abstract class Unit implements \Bitkit\Core\Interfaces\UnitActions
{
    public static function test () 
    {
        echo 'This text made of class'; 
    }

    public static function testSomeElse () 
    {
        echo 'This text made of by another method'; 
    }
}