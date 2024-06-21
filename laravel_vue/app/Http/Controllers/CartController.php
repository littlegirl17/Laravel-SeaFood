<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $image = $request->input('image');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        //Kiểm tra product có trong cart chưa
        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            //Có rồi thì tăng số lượng
            $cart[$id]['quantity'] += $quantity;
        }else{
            // chưa có, thì lưu các item đó vào mảng $cart[$id] $id để xác định sản phẩm trong giỏ hàng bằng một định danh duy nhất
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        //Lưu cart vào session
        session()->put('cart', $cart);
        return response()->json($cart); // Trả về giỏ hàng dưới dạng JSON
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