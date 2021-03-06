<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel 
{
    private $email;
    private $password;
    private $username;
    private $role;
    private $status;

  
    public  static function getTableName()
    {
        return 'app_user';
    }

    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * 
                FROM app_user 
                WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([":email" => $email]);

        //retourne false si pas trouvé, ou un objet AppUser tout hydraté si trouvé
        return $stmt->fetchObject(self::class);
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM app_user 
                ORDER BY username ASC, `role` ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        //'App\Models\AppUser'
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO app_user (username, email, password, role /* , firstname, lastname status */) 
                VALUES (:username, :email, :password, :role /* , :firstname, :lastname :status */)";

        $stmt = $pdo->prepare($sql);
        $insertedRows = $stmt->execute([
            ":email" => $this->email, 
            ":password" => $this->password, 
            ":username"=>$this->username,
            ":role" => $this->role, 
            // ":status" => $this->status
        ]);

        if ($insertedRows){
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function update()

    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `app_user`
            SET
                email = :email,
                password = :password,
                username = :username 
                role = :role,
                
            WHERE id = :id
        ";


        $stmt=$pdo->prepare($sql);


        $updatedRows = $stmt->execute([
          ":email" => $this->email,
          ":password" => $this->password,
          ":username" => $this->username,
          ":role" => $this->role, 
          ":id" => $this->id
          ]);
  
          return ($updatedRows > 0);
    }


    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
}