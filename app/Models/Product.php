<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel {



    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var string
     */
    private $image;
     /**
     * @var string
     */
    private $video;
    /**
     * @var string
     */
    private $description;
     /**
     * @var string
     */
    private $include;
    /**
    * @var int
    */
    private $category_id;
    /**
    * @var int
    */
    private $subCategory_id;
    /**
    * @var int
    */
    private $status;
    /**
    * @var int
    */
    private $price;
    /**
    * @var int
    */
    private $product_id;
    
    /**
    * @var string
    */
    private $slug;

    /**
     * Method to get the table's name
     * 
     *
     * @return void
     */
    public  static function getTableName()
    {
        return 'product';
    }

    /**
     * Find all Products of one category
     *
     * @param int $id
     * @return void
     */
    public static function findProductsByCategory($id)
    {  
        $sql = "SELECT product.id, product.name,product.image,product.subCategory_id, category.name AS category_name 
        FROM product 
        JOIN category ON product.category_id = category.id
        WHERE product.category_id = $id
        ORDER BY product.name ASC  
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
    

    /**
     * Find all the picture of one product
     *
     * @param int $id
     * @return void
     */
    public static function findAllPicturesByProduct($id)
    {
        $sql = " SELECT picture.*
        FROM picture
        JOIN product on picture.product_id = product.id
        WHERE product.id= $id ";
        //récupère pdo
    $pdo = Database::getPDO();

     //exécute la requête
    $stmt = $pdo->query($sql);
    //récupérer le résultat
    $product = $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    //renvoye le résultat à celui qui nous a appelé
    return $product;
    }
 
    public static function findPictureById($id)
    {
        $pdo = Database::GETPDO();

        $sql = "SELECT *
        FROM picture
        WHERE id = :id";

        // prépare notre requête
        $pdoStatement = $pdo->prepare($sql);
        //exécute la requête
        $pdoStatement->execute([":id" => $id]);
        // un seul résultat => fetchObject
        $result = $pdoStatement->fetchObject(self::class);
        return $result;
    }




    /**
     * insert product
     *
     * @return void
     */
    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
            INSERT INTO `product` (name, description, include ,video, image, status, price, category_id, subcategory_id, slug ,created_at)
            VALUES (:name, :description, :include ,:video, :image, :status, :price, :category_id, :subcategory_id, :slug, NOW() ) 
        ";
        //on envoie notre requête au serveur MySQL, sans l'exécuter
        $stmt = $pdo->prepare($sql);
        //dump($stmt);
        $insertedRows = $stmt->execute([
        ":name" => $this->name,
        ":description" => $this->description,
        ":include" => $this->include,
        ":image" => $this->image,
        ":video" =>$this->video,
        ":status" => $this->status,
        ":price" => $this->price,
        ":category_id" => $this->category_id,
        ":subcategory_id" => $this->subCategory_id,
        ":slug" => $this->slug    
        ]);
        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();
            return $this->id;
            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `product`
            SET
                name = :name,
                description = :description,
                include = :include, 
                image = :image,
                video = :video, 
                price = :price,
                status = :status,
                category_id = :category_id,
                subcategory_id = :subcategory_id,
                slug = :slug,
                updated_at = NOW()
            WHERE id = :id
        ";
        
        $stmt=$pdo->prepare($sql);
        $updatedRows = $stmt->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":include" => $this->include,
            ":image" => $this->image,
            ":video" => $this->video,
            ":status" => $this->status,
            ":price" => $this->price,
            ":category_id" => $this->category_id, 
            ":subcategory_id" => $this->subCategory_id, 
            ":slug" =>$this->slug,
            ":id" => $this->id
        ]);
        return ($updatedRows > 0);
    }


    /**
     * insert in picture 
     * with product_id 
     *
     * @return int
     */
    public function insertInPicture(){
        //$image = $this->image;
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `picture` (picture,product_id)
                 VALUES (:picture, :picture_id)";
        $stmt = $pdo->prepare($sql);
        $updatedRows = $stmt->execute([
            ":picture" => $this->picture, 
            ':picture_id' => $this->product_id
        ]);
        return $updatedRows;
    }
    public function UpdateInPicture(){
        //$image = $this->image;
        $pdo = Database::getPDO();
        $sql = "UPDATE `picture`
                SET
            picture = :picture,
            picture_id = :picture_id,
            updated_at = NOW()
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $updatedRows = $stmt->execute([
            ":picture" => $this->picture, 
            ':picture_id' => $this->product_id
        ]);
        return $updatedRows;
    }


    /**
     * delete the seconds pictures
     * table picture
     *
     * @param int $id
     * @return void
     */
    public static function deleteInPicture($id) 
    {
        $pdo = Database::getPDO();
        // Ecriture de la requête UPDATE
        $sql = "
        DELETE FROM picture WHERE id = :id
        ";
        //on envoie notre requête au serveur MySQL, sans l'exécuter
        $stmt = $pdo->prepare($sql);
        $deletedRows = $stmt->execute([ ":id" => $id]);

        // On retourne VRAI, si au moins une ligne supprimé
        return ($deletedRows > 0);
    }



    /**
     * return an array for status 
     * in ProductController add & upload 
     *
     * @return void
     */
    public static function status()
    {
        $status = [
            1 => "disponible",
            2 => "no disponible"
        ];

        return $status;
    }



/* Getter and Setter */
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
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

     /**
     * Get the value of category_id
     *
     * @return  int
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  int  $price
     *
     * @return  self
     */ 
    public function setPrice( $price)
    {
        $this->price = $price;

        return $this;
    }

   
    /**
     * Get the value of include
     *
     * @return  string
     */ 
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Set the value of include
     *
     * @param  string  $include
     *
     * @return  self
     */ 
    public function setInclude($include)
    {
        $this->include = $include;

        return $this;
    }

    /**
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of product_id
     *
     * @return  int
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @param  int  $product_id
     *
     * @return  self
     */ 
    public function setProduct_id( $product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of video
     *
     * @return  string
     */ 
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set the value of video
     *
     * @param  string  $video
     *
     * @return  self
     */ 
    public function setVideo( $video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get the value of slug
     *
     * @return  string
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @param  string  $slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    

    /**
     * Get the value of subCategory_id
     *
     * @return  int
     */ 
    public function getSubCategory_id()
    {
        return $this->subCategory_id;
    }

    /**
     * Set the value of subCategory_id
     *
     * @param  int  $subCategory_id
     *
     * @return  self
     */ 
    public function setSubCategory_id($subCategory_id)
    {
        $this->subCategory_id = $subCategory_id;

        return $this;
    }
}
