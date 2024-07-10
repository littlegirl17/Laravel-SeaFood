<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $productModel;
    private $commentModel;
    private $productImageModel;
    private $couponModel;
    private $userModel;
    private $orderModel;
    private $orderProductModel;
    private $cartModel;


    public function __construct()
    {
        $this->productModel = new Product;
        $this->commentModel = new Comment;
        $this->productImageModel = new ProductImage;
        $this->couponModel = new Coupon;
        $this->userModel = new User;
        $this->orderModel = new Order;
        $this->orderProductModel = new OrderProduct;
        $this->cartModel = new Cart;
    }

    public function detail($slug)
    {
        $detail = $this->productModel->whereSlug($slug)->firstOrFail();

        $detail->view += 1;
        $detail->save(); //sử dụng để lưu thay đổi vào một bản ghi có sẵn trong cơ sở dữ liệu hoặc để tạo một bản ghi mới nếu nó chưa tồn tại.

        $productRelated = $this->productModel->productRelated($detail);

        $user = auth()->user();
        $data = [
            'detail' => $detail,
            'productRelated' => $productRelated,
            'user' => $user,
        ];

        return view('detailProduct',  $data);
    }
    public function countCart()
    {
        $cartCount = count(Session::get('cart'));
        return response()->json(['count' => $cartCount]);
    }

    public function buyNow(Request $request)
    {

        $id = $request->input('id');
        $name = $request->input('name');
        $image = $request->input('image');
        $price = $request->input('price');
        $discount_price = $request->input('discount_price');
        $quantity = $request->input('quantity');


        // chưa có, thì lưu các item đó vào mảng $cart[$id] $id để xác định sản phẩm trong giỏ hàng bằng một định danh duy nhất
        $buyNowCart = [
            'id' => $id,
            'name' => $name,
            'image' => $image,
            'price' => $price,
            'discount_price' => $discount_price,
            'quantity' => $quantity,
        ];


        //Lưu cart vào session
        session()->put('buyNowCart', $buyNowCart);
        return redirect('checkout');
    }

    public function clearBuyNowCart()
    {
        session()->forget('buyNowCart');
        return redirect('/');
    }


    public function vieworder()
    {
        $cart = [];
        if (Auth::check()) {
            $cart = $this->cartModel->getCartAll();
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
        }
        if (empty($cart)) {
            return redirect('/');
        }
        $iddh = session()->get('iddh', []);
        $viewOrderUser = $this->orderModel->getIdUserOrder($iddh);
        $viewOrderProduct = $this->orderProductModel->getIdProductOrder($iddh);

        return view('viewOrder', compact('viewOrderUser', 'viewOrderProduct'));
    }

    public function viewcheckout()
    {
        $cart = [];
        $user = auth()->user();
        if (Auth::check()) {
            $cart = $this->cartModel->getCartAll();
            // Trích xuất ra tất cả các ID của sản phẩm trong bảng cart
            $productIds = $cart->pluck('product_id')->all(); // pluck: có thể được hiểu lấy 1 fields nào đó và trả về một mảng
            // Lấy ra thông tin chi tiết của 1 san phẩm dựa trên productIds đã trích xuất từ table cart
            $products = $this->productModel->whereIn('id', $productIds)->get(); // whereIn kiểm tra giá trị của cột nằm trong một mảng
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            //array_column() trích xuất một cột (dựa vào key) từ tất cả các phần tử trong mảng $cart và trả về một mảng mới chỉ chứa các giá trị của cột đó (trong trường hợp này là các ID sản phẩm)
            $products = $this->productModel->whereIn('id', array_column($cart, 'product_id'))->get();
        }


        $buyNowCart = session()->get('buyNowCart', []);
        if (empty($cart) && empty($buyNowCart)) {
            return redirect('/');
        }


        return view('checkout', compact('cart', 'user', 'products'));
    }

    public function checkout(Request $request)
    {
        // Fetch data from API
        $response = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');
        $dataFetch = $response->json();
        $provinceName = '';
        $districtName = '';
        $wardName = '';

        //Lặp qua dữ liệu để lấy tên tỉnh
        foreach ($dataFetch as $data) {

            if ($data['Id'] == $request->province) {

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach ($data['Districts'] as $district) {

                    if ($district['Id'] == $request->district) {
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach ($district['Wards'] as $ward) {

                            if ($ward['Id'] == $request->ward) {
                                $wardName = $ward['Name'];
                                break;
                            }
                        }
                        break;
                    }
                }
                break;
            }
        }

        //Tạo mẫu đơn hàng
        $order = new Order();

        //Kiem tra neus user đã login
        if (Auth::check()) {
            $order->user_id = Auth::id(); // gán ID của người dùng đang đăng nhập
        }

        // Lưu các thông tin khác của đơn hàng
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->province = $provinceName ?: $request->input('province');
        $order->district = $districtName ?: $request->input('district');
        $order->ward = $wardName ?: $request->input('ward');
        $order->total = $request->input('total');
        $order->coupon_code = $request->input('coupon_code');
        $order->note = $request->input('note');
        $order->status_id = 1; //mặc định là 1
        $order->payment = 1; //mặc định là 1
        $order->order_code = 'SEAFOOD-' . rand(10000, 999999);
        $order->save();

        session()->put('iddh', $order);

        // Lưu các sản phẩm vào bảng OrderProduct

        $cart = [];
        if (Auth::check()) {
            $cart = $this->cartModel->getCartAll();
        } else {
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
        }

        //LINK HÀM: lưu thông tin sản phẩm, số lượng, thành tiền vào bảng (OrderProduct)(MỤC ĐÍCH: tách ra từng phần dễ quản lý)
        $this->checkoutProductCart($cart, $order);

        $buyNowCart = session()->get('buyNowCart', []);
        if (!empty($buyNowCart)) {
            // Lưu sản phẩm "mua ngay" vào bảng OrderProduct
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id; // ID của đơn hàng mới vừa được tạo
            $orderProduct->product_id = $buyNowCart['id']; // ID của sản phẩm trong giỏ hàng
            $orderProduct->name = $buyNowCart['name'];
            $orderProduct->price = $buyNowCart['discount_price'] ?? $buyNowCart['price'];
            $orderProduct->quantity = $buyNowCart['quantity'];
            $orderProduct->total = $orderProduct->price * $buyNowCart['quantity']; // Giá có thể là giá giảm (discount_price) nếu nó tồn tại, nếu không sẽ sử dụng giá gốc (price)
            $orderProduct->save();

            $product = $this->productModel->findOrFail($buyNowCart['id']);
            $product->quantity -= $buyNowCart['quantity'];
            $product->save();
        }

        // Xóa sản phẩm khỏi giỏ hàng sau khi tạo đơn hàng
        if (Auth::check()) {
            $user = Auth::user()->id;
            $cart = $this->cartModel->where('user_id', $user)->delete();
        }
        $removeCookieCart = cookie()->forget('cart');

        session()->forget('buyNowCart');
        session()->forget('coupon');

        return redirect('/vieworder')->withCookie($removeCookieCart);
    }


    public function checkoutProductCart($cart, $order)
    {
        //lưu thông tin sản phẩm, số lượng, thành tiền vào bảng (OrderProduct)
        foreach ($cart as $item) {
            $product = $this->productModel->where('id', $item['product_id'])->first();
            $user = auth()->user();
            $price = $product ? $product->price : 0;
            if ($user && $user->userGroup) {
                $userGroup = $user->userGroup->id;
                $userProductDiscount = $product->productDiscounts
                    ->where('user_group_id', $userGroup)
                    ->first();
                if ($userProductDiscount) {
                    $price = $userProductDiscount->price;
                }
            }

            $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
            $userProductDiscountDefault = $product->productDiscounts
                ->where('user_group_id', $userGroup)
                ->first();
            if ($userProductDiscountDefault) {
                $price = $userProductDiscountDefault->price;
            }
            $ThanhTien = $price * $item['quantity'];

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id; //Đây là ID của đơn hàng mới vừa được tạo. Khi tạo một mẫu OrderProduct, cần liên kết nó với ID của đơn hàng đó.
            $orderProduct->product_id = $item['product_id']; //ID của sản phẩm
            $orderProduct->name = $product->name;
            $orderProduct->price =  $price;
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->total =  $ThanhTien;
            $orderProduct->save();

            $product = $this->productModel->findOrFail($item['product_id']);
            $product->quantity -= $item['quantity'];
            $product->save();
        }
    }

    public function couponDelete()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            session()->forget('coupon');
            return redirect('/cart')->with('message', 'Xóa mã giảm giá thành công');
        }
    }

    public function couponApply(Request $request)
    {

        $data = $request->all(); // Lấy dữ liệu từ yêu cầu

        $coupon = $this->couponModel->where('code', $data['couponCode'])->where('status', 1)->first(); // Tìm kiếm mã giảm giá trong cơ sở dữ liệu

        // Nếu tìm thấy mã giảm giá
        if ($coupon) {
            $count_coupon = $coupon->count(); //Đếm số lượng mã giảm giá.

            $cart = [];
            if (Auth::check()) {
                $cart = $this->cartModel->getCartAll();
            } else {
                $cart = json_decode(request()->cookie('cart'), true) ?? [];
            }
            if (empty($cart) || count($cart) == 0) {
                return redirect('/cart')->with('error', 'Không có sản phẩm trong giỏ hàng để áp mã giảm giá');
            }
            // Tính tổng giá trị của giỏ hàng
            $total = 0;
            foreach ($cart as $item) {
                $product = $this->productModel->where('id', $item['product_id'])->first();
                $user = auth()->user();
                $price = $product ? $product->price : 0;
                if ($user && $user->userGroup) {
                    $userGroup = $user->userGroup->id;
                    $userProductDiscount = $product->productDiscounts
                        ->where('user_group_id', $userGroup)
                        ->first();
                    if ($userProductDiscount) {
                        $price = $userProductDiscount->price;
                    }
                }

                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                $userProductDiscountDefault = $product->productDiscounts
                    ->where('user_group_id', $userGroup)
                    ->first();
                if ($userProductDiscountDefault) {
                    $price = $userProductDiscountDefault->price;
                }
                $ThanhTien = $price * $item['quantity'];
                $total += $ThanhTien;
            }

            // Kiểm tra điều kiện mã giảm giá có hợp lệ không
            if ($count_coupon > 0) {
                if ($total >= $coupon->total) {
                    $cou[] = array(
                        'code' => $coupon->code,
                        'type' => $coupon->type,
                        'total' => $coupon->total,
                        'discount' => $coupon->discount,
                    );
                    Session::put('coupon', $cou);
                    Session::save();
                    return redirect('/cart')->with('message', 'Thêm mã giảm giá thành công');
                } else {
                    return redirect('/cart')->with('error', 'Tổng giá trị đơn hàng không đủ để áp dụng mã giảm giá này');
                }
            }
        } else {
            return redirect('/cart')->with('error', 'Mã giảm giá không tồn tại');
        }
    }
}