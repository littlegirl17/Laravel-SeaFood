<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $orderProductModel;


    public function __construct(Product $productModel, Category $categoryModel,OrderProduct $orderProductModel){
        $this->productModel = $productModel;
        $this->categoryModel = $categoryModel;
        $this->orderProductModel = $orderProductModel;
    }

    public function search(Request $request){
        $search = $request->input('search');
        $products = $this->productModel->search($search);
        return view('search', ['products' => $products, 'search' => $search]);
    }

    public function index() {
        //lấy ra tất cả danh mục
        $categories = $this->categoryModel->categoryHome();

        //mảng này sử dụng để lưu trữ sản phẩm theo danh mục tương ứng
        $productByCategory = [];
        foreach($categories as $category){
            $productByCategory[$category->id] = $category->productByCate(); //lấy ra sản phẩm theo IDDM cụ thể
        }
        $data = [
            //Load danh mục
            'categories' => $categories,
            'productByCategory' => $productByCategory,

            //Load product nổi bật
            'productOutstanding' => $this->productModel->getOutstandingProducts(),
            'BestSeller' => $this->orderProductModel->getBestSeller(),
            'productBestSeller' => $this->productModel->getBestSellerProducts(),
            'productView' => $this->productModel->getViewedProducts(),
            'productDiscount' => $this->productModel->getDiscountProducts(),
            'soldout' => $this->productModel->getSoldOut()
        ];

        //Khi nguoi dung back chuyển về trang chủ thì tự động xoa san phẩm MUA NGAY LIỀN
        Session::forget('buyNowCart');
        return view('home', $data);
    }


}