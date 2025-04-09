<?php

class Repository 
{
    protected $db;
    protected $tableName;
    
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->db = ConnexionDB::getInstance();
    }
    
    public function findAll()
    {
        $query = "SELECT * FROM {$this->tableName}";
       
        $response = $this->db->query($query);
        
        $elements = $response->fetchAll(PDO::FETCH_ASSOC);
        return $elements;
    }
    
    public function findById($id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE id = :id";
        
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
        
        return $response->fetch(PDO::FETCH_ASSOC);
    }
    
    public function delete($id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE id = :id";
        
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);
        
        return $response->rowCount(); 
    }
    
    public function create($params)
    {
        $keys = array_keys($params);
        
        $keyString = implode(",", $keys);
        
        $placeholders = array_map(function($key) {
            return ":$key";
        }, $keys);
        
        $placeholderString = implode(",", $placeholders);
        
        $query = "INSERT INTO {$this->tableName} ($keyString) VALUES ($placeholderString)";
        
        $response = $this->db->prepare($query);
        $response->execute($params);
        
        return $this->db->lastInsertId(); 
    }
}