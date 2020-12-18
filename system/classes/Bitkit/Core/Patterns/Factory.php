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
        return new class  { 


            const TABLE_NAME = 'core_cards';     
            
            public static function getAllLines() : ?array   
            {
                $lines = [];
                $sql = static::getPDO()->prepare('SELECT * FROM ' . static::TABLE_NAME );
                $sql->execute();
                while ($line = $sql->fetch()) {
                    $lines[] = $line;
                }
                return $lines;
            }
            
        };
    }


}