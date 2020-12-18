<?php

namespace Bitkit\Core\Patterns;    

/**
 * Class Factory
 * @package Bitkit\Core\Patterns    
 */
abstract class Factory
{
    public static function createClass(string $tableName)  
    {
        return new class($tableName) extends \Bitkit\Core\Entities\Unit {

            const TABLE_NAME = $tableName;
            
        };  
    }


}