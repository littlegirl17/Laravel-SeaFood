<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserGroup;
use App\Models\BannerImage;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $productModel;
    private $categoryModel;
    private $orderProductModel;
    private $bannerModel;
    private $bannerImageModel;
    private $userGroupModel;
    private $productDiscountModel;

    public function __construct(Product $productModel, Category $categoryModel,OrderProduct $orderProductModel){
        $this->productModel = $productModel;
        $this->categoryModel = $categoryModel;
        $this->orderProductModel = $orderProductModel;
        $this->bannerModel = new Banner;
        $this->bannerImageModel = new BannerImage;
        $this->userGroupModel = new UserGroup;
        $this->productDiscountModel = new ProductDiscount;

    }

    public function index() {
        //lấy ra tất cả danh mục
        $categories = $this->categoryModel->categoryHome();

        //mảng này sử dụng để lưu trữ sản phẩm theo danh mục tương ứng
        $productByCategory = [];
        foreach($categories as $category){
            $productByCategory[$category->id] = $category->productByCate(); //lấy ra sản phẩm theo IDDM cụ thể
        }

        $user = auth()->user();
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
            'soldout' => $this->productModel->getSoldOut(),
            'banners' => $this->bannerModel->bannerAll(),
            'getDefaultUserGroup' => $this->productDiscountModel->getProductDiscountByDefault(),
            'user' => $user,
        ];

        //Khi nguoi dung back chuyển về trang chủ thì tự động xoa san phẩm MUA NGAY LIỀN
        Session::forget('buyNowCart');
        return response()->json($data);// response là trả về cái phản hồi | chuyển đổi $data thành chuỗi Json =>để trả về dữ liệu JSON cho client
    }


}
