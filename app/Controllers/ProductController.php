<?php
//TODO trouver un moyen de passer les messages
namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Utils\Validator;
use Respect\Validation\Validator as v;
use Respect\Validation\Rules;
use Respect\Validation\Exceptions\NestedValidationException;
use SplFileInfo;

class ProductController extends CoreController
{
    /******************************FrontOffice**********************************************/


    public function showProduct($id)
    {
        $product = Product::find($id);
        $pictures = Product::findAllPicturesByProduct($id);

        $this->show('front/product/detail', ['product' => $product, "pictures" => $pictures]);
    }



    /******************************BackOffice**********************************************/

    /**
     * create new Product
     *
     * @return void
     */
    public function add()
    {
        if (isset($_POST['upload'])) {

            $subCategoryId = 0;

            $name = strip_tags(filter_input(INPUT_POST, 'name'));;
            $include = filter_input(INPUT_POST, 'include');
            $description = filter_input(INPUT_POST, 'description');
            $video = filter_input(INPUT_POST, 'video', FILTER_VALIDATE_URL);
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));
            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $slug = Validator::slugify($name);
            if (!empty($subCategoryId)) {
                $subCategoryId = strip_tags(filter_input(INPUT_POST, 'subCategory_id'));
            }

            $product = new Product();
            $validator = new Validator;

            //INSERT IMAGE PRINCIPAL
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];
            if (!empty($imgFile)) {
                if (!is_null($uploadedPic = $validator->uploadPicture($imgFile, $tmp_dir, $imgSize))) {
                    $product->setImage($uploadedPic);
                }
            } else {
                $validator->setErrors("Image requiered ");
            }

            $product->setName($name);
            $product->setDescription($description);
            $product->setInclude($include);
            $product->setVideo($video);
            $product->setStatus($status);
            $product->setPrice($price);
            $product->setCategory_id($categoryId);
            $product->setSubCategory_id($subCategoryId);
            $product->setSlug($slug);

            //VALIDATION
            //FROM RESPECT/VALIDATION
            $maxCategory = Category::findMaxId('category')['max_id'];
            $maxSubCategory = Category::findMaxId('subcategory')['max_id'];

            $userValidator = v::attribute('name', v::notEmpty()->length(3, null))
                ->attribute('description', v::notEmpty())
                ->attribute('include', v::notEmpty())
                ->attribute('video', v::url())
                ->attribute('status', v::number()->between(0, 1))
                ->attribute('price', v::number())
                ->attribute('category_id', v::number()->between(1, $maxCategory))
                ->attribute('subCategory_id', v::number()->between(0, $maxSubCategory))
                ->attribute('slug', v::slug());

            try {
                $userValidator->assert($product);
            } catch (NestedValidationException $ex) {

                $coll = collect($ex->getMessages());
                //dump($coll);

                $messages = $coll->flatten();
                dump($messages);
                foreach ($coll as $key => $message)
                    $errorList["'$key'"] = $message;
            }

          


            if (isset($_POST['imagesWithId[]']) && empty($messages) && empty($errorsInUploadPicture)) {
                //recupère le lastInsertId et le stock dans une variable
                //qu'on utilise pour comme product_id  
                if ($lastId = $product->insert()) {
                    $erroList['success'] = "Your product has been added";
                    dump("coucou après insert");
                    $total = count($_FILES['imagesWithId']['name']);
                    // Loop through each file
                    for ($i = 0; $i < $total; $i++) {
                        $imgFile = $_FILES['imagesWithId']['name'][$i];
                        $tmp_dir = $_FILES['imagesWithId']['tmp_name'][$i];
                        $imgSize = $_FILES['imagesWithId']['size'][$i];

                        $pictures = new Product;
                        if (!is_null($uploadedPic = $validator->uploadPicture($imgFile, $tmp_dir, $imgSize))) {
                            $pictures->setPicture($uploadedPic);
                            $pictures->setProduct_id($lastId);
                        }

                        if ($pictures->insertInPicture()) {
                            $erroList['success'] = "Aditionals pictures have been added";
                        }
                    }
                }
            }
        }

        //recupère les erreurs dans la fonction $uploadedPic
        $errorsInUploadPicture = $validator->getErrors();
        //permet de definir le statut
        $status = Product::status();
        //on passe ce tableau de résultats à la vue
        $this->show(
            'back/product/add',
            [
                "allCategories" => Category::findAll(),
                "status" => $status,
                "errorsPicture" => $errorsInUploadPicture,
                "messageValidation" => $errorList
            ]
        );
    }

    /**
     * Update a Product
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        if (!empty($_POST['update'])) {

            //récupère les données du form
            //le strip_tags vire les éventuelles balises HTML des données 
            //ça nous protège des attaques XSS
            $name = strip_tags(filter_input(INPUT_POST, 'name'));
            $include = filter_input(INPUT_POST, 'include');
            $description = filter_input(INPUT_POST, 'description');
            $video = filter_input(INPUT_POST, 'video', FILTER_VALIDATE_URL);
            $status = strip_tags(filter_input(INPUT_POST, 'status'));
            $price = strip_tags(filter_input(INPUT_POST, 'price'));
            $categoryId = strip_tags(filter_input(INPUT_POST, 'category_id'));
            $slug = str_replace(" ", "-", $name);

            //INSERT IMAGE PRINCIPAL
            $imgFile = $_FILES['image']['name'];
            $tmp_dir = $_FILES['image']['tmp_name'];
            $imgSize = $_FILES['image']['size'];
            $picturePrin = Product::find($id)->getImage();

            $updatedImg = Validator::updatePicture($picturePrin, $tmp_dir, $imgFile, $imgSize);



            $product = new Product();
            $product->setId($id);
            $product->setName($name);
            $product->setDescription($description);
            $product->setInclude($include);
            $product->setImage($updatedImg);
            $product->setVideo($video);
            $product->setStatus($status);
            $product->setPrice($price);
            $product->setCategory_id($categoryId);
            $product->setSlug($slug);
            //si l'insert s'est bien passé... 
            if ($product->update()) {
                dd('coucou');

                $total = count($_FILES['imagesWithId']['name']);
                // Loop through each file
                for ($i = 0; $i < $total; $i++) {
                    $imgFile = $_FILES['imagesWithId']['name'][$i];
                    $tmp_dir = $_FILES['imagesWithId']['tmp_name'][$i];
                    $imgSize = $_FILES['imagesWithId']['size'][$i];
                    if (empty($imgFile)) {
                        $errMSG = "Selecionna una imagen.";
                    } else {
                        $uploadedPic = Validator::uploadPicture($imgFile, $tmp_dir, $imgSize);

                        // Ajout BDD
                        $pictures = new Product;
                        $pictures->setPicture($uploadedPic);
                        $pictures->setProduct_id($id);

                        if ($pictures->insertInPicture()) {
                            $_SESSION['alert'] = "El producto " . $name . " ha sido modificado!";
                            //on redirige vers la liste des produits
                            //$this->redirectToRoute("produ");     
                        };
                    }
                }
            }
        }

        $this->show(
            'back/product/update',
            [
                "product" => Product::find($id),
                "status" =>  Product::status(),
                "imagesWithId" => Product::findAllPicturesByProduct($id),
                "allCategories" => Category::findAll(),
                "allSubCategories" => SubCategory::findAll()
            ]
        );
    }

    /**
     * Delete additionals photos
     *
     * @route 
     * @param int $id
     * @return void
     */
    public function deleteImageAddi($id)
    {
        $result = Product::findPictureById($id);
        $picture = $result->getPicture();
        $categoryId = $result->getProduct_id();
        //dd($picture);
        // select image from db to delete 
        unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/img/productos/' . $picture);
        // it will delete an actual record from db
        Product::deleteInPicture($id);

        $this->redirectToRoute("admin-product-update", ['id' => $categoryId]);
    }

    /**
     * list product 
     * @route /admin/product/list, name = admin-product-list
     * 
     * @return void
     */
    public function listProductAdmin()
    {

        $category = Category::findAll();
        $products = Product::findAll();
        $this->show('back/product/list', ['categories' => $category, 'products' => $products]);
    }
}
