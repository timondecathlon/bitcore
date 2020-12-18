<?php

namespace Bitkit\Core\Patterns;    

/**
 * Class Factory
 * @package Bitkit\Core\Patterns    
 */ 
class Factory  
{
    public static function createClass($tableName)  
    {
        return new class extends \Bitkit\Core\Entities\Unit { 

            const TABLE_NAME = $tableName;  
            
        };
    }


}