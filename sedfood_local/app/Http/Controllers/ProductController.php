<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Decimal;

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

        return view('detailProduct',  $data);
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
        //id của sản phẩm đó sẽ trả về slug của sản phẩm đó
        return redirect('detail-product/'.$product->slug);
    }

    public function viewCart(Request $request){
        $cart = $request->session()->get('cart', []);
        return view('cart',compact('cart'));
    }

    public function addToCart(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $image = $request->input('image');
        $price = $request->input('price');
        $discount_price = $request->input('discount_price');
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
                'discount_price' => $discount_price,
                'quantity' => 1,
            ];
        }



        //Lưu cart vào session
        session()->put('cart', $cart);
        return redirect('/viewCart');
    }

    public function tangQuantity($id){
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect('/viewCart');
    }

    public function giamQuantity($id){
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            if($cart[$id]['quantity'] > 1){
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
            }else{
                return redirect('/viewCart')->with('warning', 'Số lượng ít nhất là 1.');
            }

        }

        return redirect('/viewCart');
    }

    public function deleteItemCart($id){

        //lấy ra giỏ hàng từ session
        $cart = session()->get('cart', []);

        //Nếu có thì tiến hành xóa
        if(isset($cart[$id])){
            session()->forget('cart.' .$id);
        }
        return redirect('/viewCart');
    }

    public function deleteAllCart(){
        $cart = session()->get('cart', []);
        session()->forget('cart');
        return redirect('/viewCart');
    }

    public function checkout(Request $request){

        //Tạo mẫu đơn hàng
        $order = new Order();
        if(Auth::check()){
            $order->user_id = Auth::id(); // gán ID của người dùng đang đăng nhập
        }else{
            $user = $this->userModel->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'province' => $request->input('province'),
                'district' => $request->input('district'),
                'ward' => $request->input('ward'),
            ]);

            // Gán ID của người dùng mới vào bảng Order
            $order->user_id = $user->id;
        }


        // Lưu các thông tin khác của đơn hàng
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->province = $request->input('province');
        $order->district = $request->input('district');
        $order->ward = $request->input('ward');
        $order->total = $request->input('total');
        $order->coupon_code = $request->input('coupon_code');
        $order->save();

        // Lưu các sản phẩm vào bảng OrderProduct
        $cart = session()->get('cart', []);
       // $total = 0;

        foreach($cart as $item){
          //  $total += $item['price'] * $item['quantity'];
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;//Đây là ID của đơn hàng mới vừa được tạo. Khi tạo một mẫu OrderProduct, cần liên kết nó với ID của đơn hàng đó.
            $orderProduct->product_id = $item['id'];//ID của sản phẩm trong giỏ hàng.
            $orderProduct->name = $item['name'];
            $orderProduct->price = $item['price'];
            $orderProduct->total =  $item['price']*$item['quantity'];
            $orderProduct->save();
        }

        // Xóa sản phẩm khỏi giỏ hàng sau khi tạo đơn hàng
        session()->forget('cart');
        session()->forget('coupon');

        return redirect('/vieworder');
    }

    public function couponDelete(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            session()->forget('coupon');
            return redirect('/checkout')->with('message','Xóa mã giảm giá thành công');
        }
    }

    public function couponApply(Request $request){
        $data = $request->all();
        $coupon = $this->couponModel->where('code', $data['coupon'])->first();

        if($coupon){
            $count_coupon = $coupon->count();
            $cart = Session::get('cart', []);
            $total = 0;
            foreach ($cart as $item) {
                if (is_array($item)) { // Kiểm tra xem $item có phải là một mảng hay không
                    $ThanhTien = isset($item['discount_price']) ? $item['discount_price'] * $item['quantity'] : $item['price'] * $item['quantity'];
                    $total += $ThanhTien;
                }
            }
            if($count_coupon > 0){
                if($total >= $coupon->total){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session == true){
                        $is_avaiable = 0;
                        if($is_avaiable == 0){
                            $cou[] = array(
                                'code'=>$coupon->code,
                            'type'=>$coupon->type,
                            'total'=>$coupon->total,
                            'discount'=>$coupon->discount,
                            );
                            Session::put('coupon', $cou);
                        }
                    }else{
                        $cou[] = array(
                            'code'=>$coupon->code,
                            'type'=>$coupon->type,
                            'total'=>$coupon->total,
                            'discount'=>$coupon->discount,
                        );
                        Session::put('coupon', $cou);
                    }
                    Session::save();
                    return redirect('/checkout')->with('message','Thêm mã giảm giá thành công');
                }else{
                    return redirect('/checkout')->with('error','Tổng giá trị đơn hàng không đủ để áp dụng mã giảm giá này');
                }

            }
        }else{
            return redirect('/checkout')->with('error','Mã giảm giá không đúng');
        }
    }
/*
    public function couponApply(Request $request){
        $data = $request->all();
        $coupon = $this->couponModel->where('code',$data['coupon'])->first();
        //dd($coupon->code);

        if($coupon){
            $cart = Session::get('cart');

            $total = 0;
            $discount_coupon = 0;
            foreach ($cart as $item) {
                if (is_array($item)) { // Kiểm tra xem $item có phải là một mảng hay không
                    $ThanhTien = isset($item['discount_price']) ? $item['discount_price'] * $item['quantity'] : $item['price'] * $item['quantity'];
                    $total += $ThanhTien;
                }
            }

            if($total >= $coupon->total){
                $discount_coupon = isset($item['discount_price']) ? intval($item['discount_price']) * $item['quantity'] : intval($item['price']) * $item['quantity'];
                $newTotal = $total - $discount_coupon;

                Session::put('cart.total', $newTotal);

                $order = new Order([
                    'total' => $newTotal,
                ]);

                $order->save();

                $couponSession  = [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'total' => $coupon->total,
                    'discount' => $discount_coupon,
                    'newTotal' => $newTotal,
                ];

                Session::put('coupon', $couponSession );
                Session::save();
                return redirect('/checkout')->with('message', 'Mã giảm giá đã được áp dụng!');
            }else{
                return redirect('/checkout')->with('error', 'Tổng giá trị đơn hàng phải lớn hơn hoặc bằng ' . number_format($coupon->total, 0, ',', '.') . 'đ mới áp dụng mã!');
            }
        }else{
            return redirect('/checkout')->with('error', 'Mã không hợp lệ!');
        }
    }*/

}