<?php

namespace Bitkit\Core\Patterns;    

/**
 * Class Factory
 * @package Bitkit\Core\Patterns    
 */
abstract class Factory
{
    public static function createClass($tableName) 
    {
        return new class($tableName) extend \Bitkit\Core\Entities\Unit {
            const TABLE_NAME = $tableName;
            
        }
    }


}