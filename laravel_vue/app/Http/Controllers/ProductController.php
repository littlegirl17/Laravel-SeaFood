<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $productModel;
    private $commentModel;
    private $productImageModel;
    private $couponModel;
    private $userModel;
    private $orderModel;
    private $orderProductModel;


    public function __construct()
    {
        $this->productModel = new Product;
        $this->commentModel = new Comment;
        $this->productImageModel = new ProductImage;
        $this->couponModel = new Coupon;
        $this->userModel = new User;
        $this->orderModel = new Order;
        $this->orderProductModel = new OrderProduct;
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

    public function viewCart(Request $request)
    {
        // session()->forget('cart');
        $cart = session()->get('cart', []);
        $user = auth()->user(); //Lấy thông tin người dùng đã đăng nhập hiện tại.
        $products = $this->productModel;
        return view('cart', compact('cart', 'user', 'products'));
    }

    public function addToCart(Request $request)
    {

        $id = $request->input('id');
        $name = $request->input('name');
        $image = $request->input('image');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        //Kiểm tra product có trong cart chưa
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            //Có rồi thì tăng số lượng
            $cart[$id]['quantity'] += $quantity;
        } else {
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
        return redirect()->back();
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


    public function tangQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect('/viewCart');
    }

    public function giamQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
            } else {
                return redirect('/viewCart')->with('warning', 'Số lượng ít nhất là 1.');
            }
        }

        return redirect('/viewCart');
    }

    public function deleteItemCart($id)
    {

        //lấy ra giỏ hàng từ session
        $cart = session()->get('cart', []);

        //Nếu có thì tiến hành xóa
        if (isset($cart[$id])) {
            session()->forget('cart.' . $id);
        }
        return redirect('/viewCart');
    }

    public function deleteAllCart()
    {
        $cart = session()->get('cart', []);
        session()->forget('cart');
        return redirect('/viewCart');
    }

    public function vieworder()
    {
        $cart = session()->get('cart', []);
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
        $cart = session()->get('cart', []);
        $buyNowCart = session()->get('buyNowCart', []);
        if (empty($cart) && empty($buyNowCart)) {
            return redirect('/');
        }

        $user = auth()->user();
        $products = $this->productModel;

        return view('checkout', compact('user', 'products'));
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
        $order->order_code = 'SEAFOOD-' . rand(10000, 999999);
        $order->save();

        session()->put('iddh', $order);

        // Lưu các sản phẩm vào bảng OrderProduct
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            // $total += $item['price'] * $item['quantity'];
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id; //Đây là ID của đơn hàng mới vừa được tạo. Khi tạo một mẫu OrderProduct, cần liên kết nó với ID của đơn hàng đó.
            $orderProduct->product_id = $item['id']; //ID của sản phẩm trong giỏ hàng.
            $orderProduct->name = $item['name'];
            $orderProduct->price =  $item['discount_price'] ?? $item['price'];
            $orderProduct->quantity = $item['quantity'];
            $orderProduct->total =  $orderProduct->price * $item['quantity']; //Điều này có nghĩa là giá (price) có thể là giá giảm (discount_price) nếu nó tồn tại, nếu không sẽ sử dụng giá gốc (price).
            $orderProduct->save();

            $product = $this->productModel->findOrFail($item['id']);
            $product->quantity -= $item['quantity'];
            $product->save();
        }

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
        session()->forget('cart');
        session()->forget('buyNowCart');
        session()->forget('coupon');

        return redirect('/vieworder');
    }

    public function couponDelete()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            session()->forget('coupon');
            return redirect('/viewCart')->with('message', 'Xóa mã giảm giá thành công');
        }
    }

    public function couponApply(Request $request)
    {

        // Kiểm tra tồn tại giỏ hàng
        if (!Session::has('cart')) {
            return redirect('/');
        }

        $data = $request->all(); // Lấy dữ liệu từ yêu cầu

        $coupon = $this->couponModel->where('code', $data['couponCode'])->where('status', 1)->first(); // Tìm kiếm mã giảm giá trong cơ sở dữ liệu

        // Kiểm tra xem giỏ hàng có sản phẩm nào không
        $cart = Session::get('cart', []);
        if (empty($cart) || count($cart) == 0) {
            return redirect('/viewCart')->with('error', 'Không có sản phẩm trong giỏ hàng để áp mã giảm giá');
        }
        // Nếu tìm thấy mã giảm giá
        if ($coupon) {
            $count_coupon = $coupon->count(); //Đếm số lượng mã giảm giá.

            // Tính tổng giá trị của giỏ hàng
            $total = 0;
            foreach ($cart as $item) {
                if (is_array($item)) { // Kiểm tra xem $item có phải là một mảng hay không
                    $ThanhTien = isset($item['discount_price']) ? $item['discount_price'] * $item['quantity'] : $item['price'] * $item['quantity'];
                    $total += $ThanhTien;
                }
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
                    return redirect('/viewCart')->with('message', 'Thêm mã giảm giá thành công');
                } else {
                    return redirect('/viewCart')->with('error', 'Tổng giá trị đơn hàng không đủ để áp dụng mã giảm giá này');
                }
            }
        } else {
            return redirect('/viewCart')->with('error', 'Mã giảm giá không tồn tại');
        }
    }
}
