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
            
            public function __construct($id, $table)
            {
                super::$id;
                $this->$table = $table;  
            }  


            //если static в рантайме то какого фига не могу задать?
            ..public static $table = $table;
            //const TABLE_NAME = 'core_cards';   
            
            public static function getAllLines() : ?array   
            {
                $lines = [];
                $sql = static::getPDO()->prepare('SELECT * FROM ' . $this->$table );
                $sql->execute();
                while ($line = $sql->fetch()) {
                    $lines[] = $line;
                }
                return $lines;
            }
            
        };
    }


}