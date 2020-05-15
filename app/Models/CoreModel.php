<?php

namespace App\Models;
use App\Utils\Database;
use PDO;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel {

    //une méthode définie comme abstraite doit absolument être implémentée par tous ses enfants ! 
    abstract public static function getTableName();


    public static function delete($id)
    {
        $pdo = Database::getPDO();

        $tableName = static::getTableName();

        $sql = "DELETE FROM $tableName WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    //factorisation find
    public static function find($id)
    {
        $pdo = Database::getPDO();

        $tableName = static::getTableName();

        $sql = "SELECT * FROM $tableName WHERE id = :id";

        // prépare notre requête
        $stmt = $pdo->prepare($sql);
       
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetchObject(static::class);
        //dump($result);
        return $result;
       
    }

public static function findAll()
    {
        $pdo = Database::getPDO();

        $tableName = static::getTableName();

        $sql = "SELECT * FROM $tableName ";
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        return $results;
    }

    public static function findMaxId($tableName){

        $pdo = Database::getPDO();

        

        $sql = "SELECT MAX(id) AS max_id FROM $tableName ";
        
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetch();
        return $results;
    }


    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */ 
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param  string  $updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
