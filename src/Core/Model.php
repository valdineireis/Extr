<?php

namespace Extr\Core;

abstract class Model
{
    private $stmt;
    private $db;

    public function __construct()
    {
        global $config;

        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        try {
            $this->db = new \PDO(
                "mysql:dbname={$config['dbname']};host={$config['host']}", 
                $config['dbuser'], 
                $config['dbpass'], 
                $options
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Prepare statment with query
	protected function query($sql)
	{
		$this->stmt = $this->db->prepare($sql);
    }
    
    // Bind values 
    protected function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
                break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    protected function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    protected function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Get single record as object 
    protected function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Get row count 
    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
