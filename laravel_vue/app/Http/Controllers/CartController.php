<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    private $cartModel;
    private $productModel;


    public function __construct()
    {

        $this->cartModel = new Cart;
        $this->productModel = new Product;
    }

    public function getCart()
    {
        try {
            if (Auth::check()) {
                // lấy tất cả sản phẩm trong table cart
                $cart = $this->cartModel->getCartAll();

                $user = auth()->user();

                // Trích xuất ra tất cả các ID của sản phẩm trong bảng cart
                $productIds = $cart->pluck('product_id')->all(); // pluck: có thể được hiểu lấy 1 fields nào đó và trả về một mảng

                // Lấy ra thông tin chi tiết của 1 san phẩm dựa trên productIds đã trích xuất từ table cart
                $products = $this->productModel->whereIn('id', $productIds)->get(); // whereIn kiểm tra giá trị của cột nằm trong một mảng

                return view('cart', compact('cart', 'user', 'products'));
            } else {
                // giải mã 1 chuỗi json thành 1 mảng kết hợp
                $cart = json_decode(request()->cookie('cart'), true) ?? [];

                //array_column() trích xuất một cột (dựa vào key) từ tất cả các phần tử trong mảng $cart và trả về một mảng mới chỉ chứa các giá trị của cột đó (trong trường hợp này là các ID sản phẩm)
                $products = $this->productModel->whereIn('id', array_column($cart, 'product_id'))->get();

                $user = auth()->user();
                return view('cart', compact('cart', 'user', 'products'));
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $userID = $request->user_id ?? (Auth::check() ? Auth::user()->id : 0);
            //$userID = $request->user_id ? (Auth::check() ? Auth::user()->id : 0) : 0;
            $productID = $request->product_id;
            $cart = $this->cartModel->checkProductCart($userID, $productID);
            if ($userID > 0) {
                if ($cart) {
                    $cart->quantity += 1;
                    $cart->save();
                } else {
                    $cart = new Cart();
                    $cart->product_id = $productID;
                    $cart->user_id = $userID;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
            } else {
                // nếu chưa đăng nhập thì lưu nó vào cookie của trình duyệt đó
                $cart = json_decode(request()->cookie('cart'), true) ?? []; // giải mã chuổi thành mảng

                // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                $existingItem = array_search($productID, array_column($cart, 'product_id'));
                if ($existingItem !== false) {
                    $cart[$existingItem]['quantity'] += 1;
                } else {
                    $newItem = [
                        'product_id' => $productID,
                        'quantity' => $request->quantity,
                    ];
                    $cart[] = $newItem;
                }

                //tạo ra cookie mới
                $cookie = cookie('cart', json_encode($cart), 0); // 0 nghĩa là lưu vĩnh viễn
                // tar về phản hồi http, kèm thro cookie cart, khi trình duyệt nhận được phản hồi thì no se lưu cookie cart vào bộ nhớ =>cập nhật lên giao diện
                return response()->json($cart)->cookie($cookie);
            }

            return response()->json($cart); // Trả về giỏ hàng dưới dạng JSON

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
