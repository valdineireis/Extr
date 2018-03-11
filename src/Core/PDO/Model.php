<?php

namespace Extr\Core\PDO;

abstract class Model extends ModelBase
{
    public function __construct()
    {
        parent::__construct();
    }


    public abstract function tableName() : string;


    public function getAll($order = null) : array
    {
        $array = array();
        
        $query = "SELECT * FROM {$this->tableName()}";

        if ($order) {
            $query .= " ORDER BY {$order}";
        }

        $this->query($query);

		$results = $this->resultSet();

		return $results;
    }


	public function getById($id) : array
	{
		$this->query('SELECT * FROM {$this->tableName()} WHERE id = :id');
        $this->bind(':id', $id);
        $row = $this->single();
        return $row;
    }
    

    public function remove($id) : boolean
	{
		$this->query('DELETE FROM {$this->tableName()} WHERE id = :id');
        $this->bind(':id', $id);

        return $this->execute() ? true : false;
    }
    

    public function insert($data) : boolean
    {
        $fileds = implode(', ', array_keys($data));
        $places = ':' . implode(', :', array_keys($data));

        $this->query("INSERT INTO {$this->tableName()} ({$fileds}) VALUES ({$places})");

        foreach ($data as $key => $value) {
            $this->bind(':{$key}', $value);
        }

        return $this->execute() ? true : false;
    }


    public function update($data, $id) : boolean
    {
        foreach ($data as $key => $value) {
            $places[] = $key . ' = :' . $key;
        }
        
        $places = implode(', ', $places);
        
        $this->query("UPDATE {$this->tableName()} SET {$places} WHERE id = :id");
        $this->bind(':id', $id);

        foreach ($data as $key => $value) {
            $this->bind(':{$key}', $value);
        }

        return $this->execute() ? true : false;
    }
}
