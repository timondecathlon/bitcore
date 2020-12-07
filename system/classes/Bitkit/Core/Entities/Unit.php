<?php

namespace Bitkit\Core\Entities;

abstract class Unit implements \Bitkit\Core\Interfaces\UnitActions
{
    public static function test () : int
    {
        echo 'This text made of class'; 
    }
}