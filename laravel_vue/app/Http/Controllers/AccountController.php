<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $categoryModel;
    private $productModel;
    private $commentModel;
    private $orderModel;
    private $userModel;
    private $orderProductModel;
    private $orderStatus;
    private $productImage;
    private $couponModel;
    private $bannerModel;
    private $bannerImageModel;
    private $userGroupModel;
    private $productDiscountModel;
    private $administrationModel;
    private $administrationGroupModel;

    public function __construct()
    {

        $this->orderModel = new Order;
        $this->orderProductModel = new OrderProduct;
        // $this->userModel = new User;
        // $this->couponModel = new Coupon;
        // $this->orderStatus = new OrderStatus;
        // $this->bannerModel = new Banner;
        // $this->bannerImageModel = new BannerImage;
        // $this->userGroupModel = new UserGroup;
        // $this->productDiscountModel = new ProductDiscount;
        // $this->administrationModel = new Administration;
        // $this->administrationGroupModel = new AdministrationGroup;
        // $this->productModel = new Product;
        // $this->productImage = new ProductImage;
        // $this->commentModel = new Comment;
    }


    public function purchase()
    {
        $user_id = Auth::user()->id;
        $orders = $this->orderModel->orderByUser($user_id);
        $orderProduct = [];
        foreach ($orders as $item) {
            $orderProduct[$item->id] = $this->orderProductModel->orderProductId($item->id);
        }
        return view('account.purchase', compact('orders', 'orderProduct'));
    }
}