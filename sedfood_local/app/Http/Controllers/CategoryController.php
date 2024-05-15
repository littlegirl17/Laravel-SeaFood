<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    private $categoryModel;
    private $productModel;

    public function __construct(){
        $this->categoryModel = new Category;
        $this->productModel = new Product;
    }
    public function index($slug){
        // Lấy danh mục cụ thể dựa trên slug
        $category = $this->categoryModel->whereSlug($slug)->firstOrFail(); //whereSlug($slug) để lấy danh mục dựa trên slug //firstOrFail() được sử dụng để trả về bản ghi đầu tiên từ kết quả truy vấn

        // Lọc các sản phẩm thuộc về danh mục có ID là $id
       $products = $this->productModel->productIddm($slug); //Lấy tất cả các sản phẩm có category_id bằng $id được truyền vào.
        // Truyền dữ liệu vào view
        $data = [
            'categories' => $category->all(),
            'products' => $products,
        ];

        return view('category', $data);
    }


}