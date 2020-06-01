<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {


    public  static function getTableName()
    {
        return 'category';
    }
    
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
     /**
     * @var string
     */
    private $has_subCat;
    /**
     * @var int
     */
    private $home_order;

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

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }


    /**
     * Get the value of has_subCat
     *
     * @return  string
     */ 
    public function getHas_subCat()
    {
        return $this->has_subCat;
    }

    /**
     * Set the value of has_subCat
     *
     * @param  string  $has_subCat
     *
     * @return  self
     */ 
    public function setHas_subCat(string $has_subCat)
    {
        $this->has_subCat = $has_subCat;

        return $this;
    }
}
