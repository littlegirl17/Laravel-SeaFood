<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    private $productModel;
    private $commentModel;
    private $productImageModel;
    private $couponModel;
    private $userModel;


    public function __construct(){
        $this->productModel = new Product;
        $this->commentModel = new Comment;
        $this->productImageModel = new ProductImage;
        $this->couponModel = new Coupon;
        $this->userModel = new User;

    }

    public function detail($slug){
        $detail = $this->productModel->whereSlug($slug)->firstOrFail();

        $detail->view += 1;
        $detail->save(); //sử dụng để lưu thay đổi vào một bản ghi có sẵn trong cơ sở dữ liệu hoặc để tạo một bản ghi mới nếu nó chưa tồn tại.

        $productRelated = $this->productModel->productRelated($detail, $slug);

        $productComment = $this->commentModel->productComment($slug);

        $productImage = $this->productImageModel->productImage($slug);

        $data = [
            'detail' => $detail,
            'productRelated' => $productRelated,
            'productComment' => $productComment,
            'productImage' => $productImage
        ];
        $kq = [
            'status' =>true,
            'message' => 'Lấy dữ liệu thành công',
            'data'=>$productComment
        ];
        return response()->json($kq, 200);

    }

    public function comment(Request $request) {
        $inputValidate = $request->validate([
            'content' => 'required',
        ]);

        $this->commentModel->create([
            'product_id' =>$request->product_id,
            'user_id' => Auth::user()->id,
            'content' => $inputValidate['content'],
        ]);

        //Tìm ra id của sản phẩm đó
        $product = $this->productModel->findOrFail($request->product_id);

        return response()->json(['message' => 'Comment added successfully']);
    }

}
