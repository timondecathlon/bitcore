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

    //abstract public function setTable();

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
        while ($line = $sql->fetch(\PDO::FETCH_LAZY)) {
            $lines[] = $line;
        }
        return $lines;
    }


    public function getLine()   
    {
        if (!$this->bdata) {    
            $sql = static::getPDO()->prepare('SELECT * FROM ' . static::TABLE_NAME . ' WHERE id=' . $this->id);
            $sql->execute();
            $this->bdata = $sql->fetch(\PDO::FETCH_LAZY);
        }
        return $this->bdata;
    }

    public function getField($field)
    {
        return trim($this->getLine()->$field);
    } 

    /**
     *
     * Метод для создания строки в таблице в БД
     *
     * @param array $fields_array
     * @param array $values_array
     * @return int
     */
    public function createLine(array $fields_array, array $values_array) : int  
    {
        /*
        $fields_str = implode(',',$fields_array);
        $placeholders_str = '';
        foreach ($fields_array as $key=>$value) {
            $placeholders_str .= ":$value,";
        }
        $placeholders_str = trim($placeholders_str,',')
        
        $sql = $this->getPDO()->prepare('INSERT INTO ' . static::TABLE_NAME . ' ($fields_str) VALUES(' . $placeholders_str . ') ');
        foreach ($fields_array as $key=>$value) {
            $sql->bindParam(":$fields_array[$key]", $values_array[$key]);
        }
        try {
            $sql->execute();
            $this->id = $this->getPDO()->lastInsertId();
            return $this->id;
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return 0;
        */
    }

    /**
     * метод для обновления нескольких полей в строке таблицы
     *
     * @param array $fields_array
     * @param array $values_array
     * @return int
     */
    public function updateLine(array $fields_array, array $values_array)  : int
    {
        /*
        $update_str = '';
        foreach ($fields_array as $key=>$value) {
            $update_str .= "$value=:$value,";
        }
        $sql = $this->getPDO()->prepare("UPDATE ". static::TABLE_NAME  ." SET ".trim($update_str,',')."  WHERE id=".$this->id);
        foreach ($fields_array as $key=>$value) {
            $sql->bindParam(":$value", $values_array[$key]);
        }
        try {
            $sql->execute();
            $this->getPDO()->errorInfo();
            return $this->getField('id');
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return 0;
        */
    }

    /**
     * Метод для обновления одного конкретного поля в строке таблицы
     *
     * @param $field
     * @param $param
     * @return bool
     */
    public function updateField($field, $param) : bool
    {
        /*
        if ($this->updateLine([$field],[$param])) {
            return true;
        }
        return false;
        */
    }

    /**
     * Метод для удаления строки из таблицы
     *
     * @return int
     */
    public function deleteLine() : int
    {
        /*
        $sql = $this->getPDO()->prepare("DELETE FROM ". static::TABLE_NAME  ." WHERE id=:id");
        $sql->bindParam(':id', $this->id);
        try {
            $post_id = $this->getField('id');
            $sql->execute();
            return $post_id;
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return 0;
        */
    }

}