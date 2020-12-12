<?php

namespace Bitkit\Core\Entities;

abstract class Unit implements \Bitkit\Core\Interfaces\UnitActions
{
    protected $id;  
    
    public $bdata; 

    /*конструктор, подключающийся к базе данных, устанавливающий локаль и кодировку соединения */
    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    abstract public function setTable();

    public static function getPDO(): \PDO
    {
        return \Bitkit\Core\Database\Connect::getInstance()->getConnection();
    }

    public function getData($data): bool
    {
        if ($this->bdata = (object)$data) {
            return true;
        }
        return false;
    }

    public static function getAllLines()    
    {
        $lines = [];
        $sql = static::getPDO()->prepare('SELECT * FROM ' . static::TABLE_NAME );
        $sql->execute();
        while ($line = $sql->fetch(PDO::FETCH_LAZY)) {
            $lines[] = $line;
        }
        return $lines;
    }


    public function getLine()   
    {
        if (!$this->bdata) {    
            $sql = static::getPDO()->prepare('SELECT * FROM ' . static::TABLE_NAME . ' WHERE id=' . $this->id);
            $sql->execute();
            $this->bdata = $sql->fetch(PDO::FETCH_LAZY);
        }
        return $this->bdata;
    }

    public function getField($field)
    {
        return trim($this->getLine()->$field);
    } 
}