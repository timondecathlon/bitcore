<?php

namespace Bitkit\Core\Entities;

abstract class Unit implements \Bitkit\Core\Interfaces\UnitActions
{
    /**
     * Свойство содержащее в себе id строки в БД
     */
    protected $id;       
    
    /**
     * Свойство содержащее в себе данные строки из БД
     */
    public $bdata; 

    /**
     * Конструктор получает и сохраняет id  
     */
    public function __construct(int $id = null)      
    {
        $this->id = $id;
    }

    //abstract public function setTable();

    /**
     * Метод полученя объекта для работы с  БД
     *
     * @return PDO
     */
    public static function getPDO(): \PDO
    {
        return \Bitkit\Core\Database\Connect::getInstance()->getConnection();
    }

    /**
     * Мотод для наполнения данными из БД во внешнем скрипте
     * 
     * @return bool     
     */
    public function getData($data): bool
    {
        if ($this->bdata = (object)$data) {
            return true;
        }
        return false;
    }

    /**
     * Метод полученя всех строк в таблице
     *
     * @return array | null  
     */
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


    public function getLine()    
    {
        if (!$this->bdata) {    
            $sql = static::getPDO()->prepare('SELECT * FROM ' . static::TABLE_NAME . ' WHERE id=' . $this->id);
            $sql->execute();
            $this->bdata = $sql->fetch(\PDO::FETCH_LAZY);
        }
        return $this->bdata;
    }

    /**
     * Метод полученя значения поля в строке по названию
     *
     * @param string $field
     * 
     * @return mixed 
     */
    public function getField($field) : mixed
    {
        return $this->getLine()->$field; 
    } 

    /**
     *
     * Метод для создания строки в таблице в БД
     *
     * @param array $fields_array
     * @param array $values_array
     * @return int
     */
    public function createLine(array $fields,array $values) : ?int  
    {
        $fields_str = implode(',',$fields);
        $placeholders_str = '';
        foreach ($fields as $key => $value) { 
            $placeholders_str .= ":$value,";
        }
        $placeholders_str = trim($placeholders_str,',');
        
        $sql = static::getPDO()->prepare('INSERT INTO ' . static::TABLE_NAME . ' ($fields_str) VALUES(' . $placeholders_str . ') ');
        foreach ($fields as $key => $value) {
            $sql->bindParam(":$fields[$key]", $values[$key]);
        }
        try {
            $sql->execute();
            return static::getPDO()->lastInsertId(); 
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return null; 
    }

    /**
     * метод для обновления нескольких полей в строке таблицы
     *
     * @param array $fields_array
     * @param array $values_array
     * @return bool 
     */
    public function updateLine(array $fields,array $values)  : bool
    {
        $update_str = '';
        foreach ($fields as $key=>$value) {
            $update_str .= "$value=:$value,";
        }
        $sql = static::getPDO()->prepare("UPDATE ". static::TABLE_NAME  ." SET ".trim($update_str,',')."  WHERE id=".$this->id);
        foreach ($fields as $key => $value) {
            $sql->bindParam(":$value", $values[$key]);
        }
        try {
            $sql->execute();
            $this->getPDO()->errorInfo();
            return true;
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage(); 
        }
        return false;  
    }

    /**
     * Метод для обновления одного конкретного поля в строке таблицы
     *
     * @param $field
     * @param $param
     * @return bool
     */
    public function updateField($field,$param) : bool
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
     * @return bool
     */
    public function deleteLine() : bool  
    {
        $sql = static::getPDO()->prepare("DELETE FROM ". static::TABLE_NAME  ." WHERE id=:id");
        $sql->bindParam(':id', $this->id);
        try {
            $sql->execute();
            return true;
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();    
        }
        return false;
    } 

} 