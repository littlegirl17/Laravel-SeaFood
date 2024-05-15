<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productModel;
    private $categoryModel;

    public function __construct(Product $productModel, Category $categoryModel){
        $this->productModel = $productModel;
        $this->categoryModel = $categoryModel;
    }
    public function index() {

        $data = [
            //Load danh mục
            'categories' => $this->categoryModel->all(),

            //Load product nổi bật
            'productOutstanding' => $this->productModel->getOutstandingProducts(),
            'productView' => $this->productModel->getViewedProducts(),
            'productDiscount' => $this->productModel->getDiscountProducts()
        ];

        return view('home', $data);
    }


}