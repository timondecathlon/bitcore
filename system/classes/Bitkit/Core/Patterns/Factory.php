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


            public static $table = 'core_cards';                  
            
        };
    }


}