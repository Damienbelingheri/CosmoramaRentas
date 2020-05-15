<?php

namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class CategoryController extends CoreController
{


    
    public function showCategory($id)
    {
        $category = Category::find($id);
        $subCategories = SubCategory::findSubCategoriesByCategory($id);
        $products = Product::findProductsByCategory($id);
        
        $this->show('front/category/list',[
            'category2' => $category,
            'products' => $products,
            'subCategories' => $subCategories
        ]);
    }
}
