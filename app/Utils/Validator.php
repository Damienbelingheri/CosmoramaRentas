<?php

namespace App\Utils;

class Validator
{
    private $errors;



    public function uploadPicture($imgFile, $tmp_dir, $imgSize)
    {

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $pic = str_replace(" ", "-", $imgFile);
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '5MB'
            // 
            if ($imgSize < 2000000) {
                //Setup our new file path
                $upload_dir = __DIR__ . '/../../public/assets/img/productos/' . $pic; // upload directory
                move_uploaded_file($tmp_dir, $upload_dir);
                return $pic;
            } else {
                $this->setErrors("Sorry, your file is too large it should be less then 2MB");
            }
        } else {
            $this->setErrors("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
    }

    public function updatePicture($pictureInDbb, $tmp_dir, $imgFile, $imgSize)
    {
        if ($imgFile) {


            
            $upload_dir = __DIR__ . '/../../public/assets/img/productos/'; // upload directory 
            //dd($upload_dir);
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $upadatedImg = str_replace(" ", "-", $pictureInDbb);
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 5000000) {
                    unlink($upload_dir . $pictureInDbb);
                    move_uploaded_file($tmp_dir, $upload_dir . $upadatedImg);
                } else {
                    $this->setErrors("Sorry, your file is too large it should be less then 2MB");
                }
            } else {
                $this->setErrors("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
        } else {
            // if no image selected the old image remain as it is.
            $upadatedImg = $pictureInDbb; // old image from database
        }

        return $upadatedImg;
    }


    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }


    public function isValid()
    {
        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}
