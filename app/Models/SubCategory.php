<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class SubCategory extends CoreModel {


    public  static function getTableName()
    {
        return 'subcategory';
    }


      /**
     * Find all Products of one category
     *
     * @param int $id
     * @return void
     */
    public static function findSubCategoriesByCategory($id)
    {  
        $sql = "SELECT subcategory.id, subcategory.subtitle, subcategory.name, category.name AS category_name 
        FROM subcategory 
        JOIN category ON subcategory.category_id = category.id
        WHERE subcategory.category_id = $id
        ORDER BY subcategory.name ASC  
        /* LIMIT 12 */";
        //récupère pdo
        $pdo = Database::getPDO();
        //exécute la requête
        $stmt = $pdo->query($sql);
        //récupérer le résultat
        $product = $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        //renvoye le résultat à celui qui nous a appelé
        return $product;
    }
    


    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $subtitle;
    /**
     * @var string
     */
   
    
    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

}
