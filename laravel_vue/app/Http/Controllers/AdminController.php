<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerImage;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
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

    public function __construct()
    {
        $this->categoryModel = new Category;
        $this->productModel = new Product;
        $this->productImage = new ProductImage;
        $this->commentModel = new Comment;
        $this->orderModel = new Order;
        $this->orderProductModel = new OrderProduct;
        $this->userModel = new User;
        $this->couponModel = new Coupon;
        $this->orderStatus = new OrderStatus;
        $this->bannerModel = new Banner;
        $this->bannerImageModel = new BannerImage;
        $this->userGroupModel = new UserGroup;
        $this->productDiscountModel = new ProductDiscount;
    }

    public function searchBanner(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_position = $request->input('filter_position');
        $filter_status = $request->input('filter_status');

        $banners = $this->bannerModel->searchBanner($filter_name, $filter_position, $filter_status);
        $positionGet = $this->bannerModel->getPosition();
        return view('admin.banner', compact('banners', 'positionGet', 'filter_name', 'filter_position'));
    }


    public function searchCategory(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_status = $request->input('filter_status');

        $categorys = $this->categoryModel->searchCategory($filter_name, $filter_status);

        return view('admin.category', compact('categorys', 'filter_name', 'filter_status'));
    }

    public function searchProduct(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_iddm = $request->input('filter_iddm');
        $filter_name = $request->input('filter_name');
        $filter_price = $request->input('filter_price');
        $filter_status = $request->input('filter_status');

        $products = $this->productModel->searchProduct($filter_iddm, $filter_name, $filter_price, $filter_status);
        $categorys = $this->categoryModel->categoryAll();
        return view('admin.product', compact('products', 'categorys', 'filter_name', 'filter_iddm'));
    }

    public function searchCoupon(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_code = $request->input('filter_code');
        $filter_total = $request->input('filter_total');
        $filter_status = $request->input('filter_status');

        $coupons = $this->couponModel->searchCoupon($filter_name, $filter_code, $filter_total, $filter_status);

        return view('admin.coupon', compact('coupons', 'filter_name', 'filter_code', 'filter_total'));
    }

    public function searchorder(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $search = $request->input('search');

        $orders = $this->orderModel->searchOrder($search);

        $productByOrder = [];
        foreach ($orders as $orderItem) {
            $productByOrder[$orderItem->id] = $this->orderProductModel->orderProductId($orderItem->id);
        }

        $isSearching = true; // Biến trạng thái để kiểm tra xem có đang tìm kiếm hay không

        return view('admin.order', compact('orders', 'productByOrder', 'isSearching'));
    }

    public function searchComment(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $search = $request->input('search');

        $comments = $this->commentModel->searchComment($search);

        return view('admin.comment', compact('comments'));
    }

    public function searchUser(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $search = $request->input('search');

        $users = $this->userModel->searchUser($search);

        return view('admin.user', compact('users'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('admin/manage');
    }

    public function manage(Request $request)
    {
        try {

            $incommingFields = $request->validate([
                'name' => 'required',
                'password' => 'required',
            ]);

            if (auth()->attempt(['name' => $incommingFields['name'], 'password' => $incommingFields['password']])) {
                $request->session()->regenerate(); //Laravel sẽ tạo ra một phiên làm việc mới, và tất cả các dữ liệu trong phiên làm việc cũ sẽ không còn có hiệu lực nữa.

                $user = auth()->user();

                if ($user->status == 0) {
                    auth()->logout();
                    return redirect('/login')->with('danger', 'Tài khoản của bạn đã bị khóa');
                } else {
                    if ($user->role >= 1) {
                        //Lưu thông tin user vào session
                        Session::put('user', auth()->user());
                        return redirect('admin/dashboard')->with('success', 'Đăng nhập thành công');
                    } else {
                        return redirect()->back()->with(['danger' => 'Email hoặc password không đúng!']);
                    }
                }
            } else {
                return redirect()->back()->with(['danger' => 'Email hoặc password không đúng!']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['login' => 'Lỗi trong quá trình đăng nhập vui lòng thử lại' . $th->getMessage()]);
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // category
    public function category()
    {
        $categorys = $this->categoryModel->categoryAll();

        return view('admin.category', compact('categorys'));
    }

    public function categoryAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->sort_order = $request->sort_order;
            $category->status = $request->status;
            $category->image = '';
            $category->save();

            // Lưu hình ảnh chính của sản phẩm
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('uploads/'), $imageName);

                $category->image = $imageName;

                $category->save();
            }
            return redirect()->route('category');
        }
        return view('admin.categoryAdd');
    }

    public function categoryEdit($id)
    {
        $category = $this->categoryModel->findOrFail($id);
        return view('admin.categoryEdit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = $this->categoryModel->findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->sort_order = $request->sort_order;
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "{$category->id}.{$image->getClientOriginalExtension()}";
            $image->move(public_path('uploads/'), $imageName);
            $category->image = $imageName;
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $category->image = $category->image;
            $category->save();
        }

        $category->save();

        return redirect()->route('category')->with('success', 'Cập nhật danh mục thành công.');
    }

    public function categoryUpdateStatus(Request $request, $id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success' => true]);
    }

    public function categoryDeleteCheckkbox(Request $request)
    {
        $category_id = $request->input('category_id');
        if ($category_id) {
            foreach ($category_id as $item) {
                $category = $this->categoryModel->findOrFail($item);
                $category->delete();
            }
        }
        return redirect()->route('category')->with('success', 'Xóa sản phẩm thành công.');
    }

    // product
    public function product()
    {
        $products = $this->productModel->productAll();
        $categorys = $this->categoryModel->categoryAll();

        return view('admin.product', compact('products', 'categorys'));
    }

    public function productAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->view = $request->view;
            $product->outstanding = $request->outstanding;
            $product->status = $request->status;
            $product->image = '';
            $product->save();

            // Lưu hình ảnh chính của sản phẩm
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('uploads/'), $imageName);

                $product->image = $imageName;

                $product->save();
            }

            // Lưu các hình ảnh khác vào bảng ProductImage
            if ($request->hasFile('images')) {
                $imageList = $request->file('images');
                foreach ($imageList as $key => $image) {
                    $imageName = "{$product->id}.{$key}.{$image->getClientOriginalExtension()}";

                    $image->move(public_path('uploads/'), $imageName);

                    $this->productImage->create([
                        'product_id' => $product->id,
                        'images' => $imageName,
                    ]);
                }
            }

            if ($request->has('user_group_id')) {
                foreach ($request->input('user_group_id') as $userGroupId) {
                    $this->productDiscountModel->create([
                        'user_group_id' => $userGroupId,
                        'product_id' => $product->id,
                        'price' => $request->input('priceUserGroup.' . $userGroupId),
                        'quantity' => $request->input('quantityUserGroup.' . $userGroupId),
                    ]);
                }
            }
            return redirect()->route('product');
        }

        $category = $this->categoryModel->all();
        $userGroup = $this->userGroupModel->all();
        return view('admin.productAdd', compact('category', 'userGroup'));
    }

    public function productEdit($id)
    {
        $product = $this->productModel->findOrFail($id);
        $category = $this->categoryModel->all();
        $userGroup = $this->userGroupModel->all();
        $productDiscount = $this->productDiscountModel->getProductDiscountById($id);
        $productImages = $this->productImage->productImages($id);
        return view('admin.productEdit', compact('product', 'category', 'productImages', 'userGroup', 'productDiscount'));
    }

    public function productUpdate(Request $request, $id)
    {

        $product = $this->productModel->findOrFail($id);

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->view = $request->view;
        $product->outstanding = $request->outstanding;
        $product->status = $request->status;
        $product->save();

        /// Lưu hình ảnh chính của sản phẩm
        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');
            // Tạo tên tệp mới dựa trên ID của sản phẩm và phần mở rộng gốc của tệp
            $imageName = "{$product->id}.{$image->getClientOriginalExtension()}";
            // Di chuyển tệp ảnh vào thư mục public/uploads
            $image->move(public_path('uploads'), $imageName);
            // Lưu đường dẫn của tệp ảnh vào thuộc tính image của sản phẩm
            $product->image = $imageName;
            // Lưu sản phẩm với đường dẫn ảnh
            $product->save();
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $product->image = $product->image;
            $product->save();
        }

        if ($request->hasFile('images')) {
            $productImages = $this->productImage->productImages($product->id);

            if ($productImages->isEmpty()) { // Nếu sản phẩm chưa có ảnh phụ
                $imageList = $request->file('images');
                foreach ($imageList as $key => $image) {
                    $imageName = "{$product->id}.{$key}.{$image->getClientOriginalExtension()}";
                    $image->move(public_path('uploads/'), $imageName);
                    $this->productImage->create([
                        'product_id' => $product->id,
                        'images' => $imageName,
                    ]);
                }
            } else { // Nếu sản phẩm đã có ảnh phụ
                foreach ($productImages as $key => $item) {
                    if ($request->hasFile("images.$key")) {
                        $imageName = "{$product->id}.{$key}.{$request->file("images.$key")->getClientOriginalExtension()}";
                        $request->file("images.$key")->move(public_path('uploads/'), $imageName);
                        $item->images = $imageName;
                        $item->update();
                    } elseif ($request->has("delete_image.$key")) {
                        $item->delete();
                    }
                }
            }
        }

        //update luôn hàm của nhóm : chia ra dầy viết cho gọn
        $this->handleUpdate_ProductDiscount_userGroup($request, $product);

        $product->save();

        return redirect()->route('product')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function productUpdateStatus(Request $request, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => true]);
    }

    public function handleUpdate_ProductDiscount_userGroup(Request $request, $product)
    {
        $checkExitsProductDiscount = $this->productDiscountModel->where('product_id', $product->id)->get();
        //Kiểm tra có thông tin của user_group_id NHÓM KHÁCH HÀNG đucợ gửi lên hay khoong
        if ($request->has('user_group_id')) {
            foreach ($request->input('user_group_id') as $index => $userGroupId) {
                $ExitsDiscount = $checkExitsProductDiscount->where('user_group_id', $userGroupId)->first();
                if ($ExitsDiscount) {
                    $ExitsDiscount->price = $request->input('priceUserGroup.' . $userGroupId);
                    $ExitsDiscount->quantity = $request->input('quantityUserGroup.' . $userGroupId);
                    $ExitsDiscount->save();
                } else {
                    // Lưu các bản ghi Product Discount mới
                    $this->productDiscountModel->updateOrCreate([
                        'user_group_id' => $userGroupId,
                        'product_id' => $product->id,
                        'price' => $request->input('priceUserGroup.' . $userGroupId),
                        'quantity' => $request->input('quantityUserGroup.' . $userGroupId),
                    ]);
                }
            }
        }
    }

    public function productDeleteCheckkbox(Request $request)
    {
        // lấy ra 1 mảng chứa id từ checkbox thông qua reqquets
        $product_id = $request->input('product_id');

        if ($product_id) { //vì nó là mảng nên ta cần foreach nó ra
            //duyệt qua từng id trong mảng product_id
            foreach ($product_id as $item) {
                //xoas luoon trong bangr producyDiscount
                $this->productDiscountModel->where('product_id', $item)->delete();
                //xoas luoon trong bangr producy_images
                $this->productImage->where('product_id', $item)->delete();
                //xoa trong bang product
                $product = $this->productModel->findOrFail($item); // tìm id san phẩm đó để xóa
                $product->delete();
            }
        }

        return redirect()->route('product')->with('success', 'Xóa sản phẩm thành công.');
    }

    public function productCopyCheckkbox(Request $request)
    {
        $product_id = $request->input('product_id');

        if ($product_id) {
            foreach ($product_id as $item) {
                $product = $this->productModel->FindOrFail($item);
                $newProduct = $product->replicate();
                $newProduct->created_at = now();
                $newProduct->updated_at = now();
                $newProduct->save();

                if ($product->image) {
                    $newImage = $product->image;
                    Storage::copy('public/uploads/' . $product->image, 'public/uploads/' . $newImage);
                    $newProduct->image = $newImage;
                    $newProduct->save();
                }
            }
        }
        return redirect()->route('product')->with('success', 'Copy sản phẩm thành công.');
    }

    public function deleteImages($id, $product_id)
    {
        $productImages = $this->productImage->findOrFail($product_id);
        $productImages->delete();
        return redirect()->back();
    }

    // coupon
    public function coupon()
    {
        $coupons = $this->couponModel->all();
        return view('admin.coupon', compact('coupons'));
    }

    public function couponAdd(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validated = $request->validate([
                'name_coupon' => 'required',
                'code' => 'required',
                'type' => 'required',
                'total' => 'required',
                'discount' => 'required',
                'status' => 'required',
            ]);

            // khởi tạo bản ghi
            $this->couponModel->create($validated);

            return redirect()->route('admin.coupon');
        }

        return view('admin.couponAdd');
    }

    public function couponEdit($id)
    {
        $coupon = $this->couponModel->findOrFail($id);
        return view('admin.couponEdit', compact('coupon'));
    }

    public function couponUpdate(Request $request, $id)
    {
        $coupon = $this->couponModel->findOrFail($id);

        $coupon->name_coupon = $request->name_coupon;
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->total = $request->total;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;
        $coupon->update();
        return redirect()->route('admin.coupon');
    }

    public function couponDeleteCheckkbox(Request $request)
    {
        $coupon_id = $request->input('coupon_id');

        if ($coupon_id) {
            foreach ($coupon_id as $itemId) {
                $coupon = $this->couponModel->findOrFail($itemId);
                $coupon->delete();
            }
        }
        return redirect()->route('admin.coupon')->with('success', 'Xóa sản phẩm thành công.');
    }

    // user
    public function user()
    {
        $users = $this->userModel->userAll();
        return view('admin.user', compact('users'));
    }

    public function userAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = new user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->province = $request->province;
            $user->district = $request->district;
            $user->ward = $request->ward;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->user_group_id = $request->user_group_id;
            $user->image = '';
            $user->save();

            // Lưu hình ảnh chính của sản phẩm
            if ($request->hasFile('image')) {
                // Lấy tên gốc của tệp
                $image = $request->file('image');

                $imageName = "{$user->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('uploads/'), $imageName);

                $user->image = $imageName;

                $user->save();
            }

            // Chuyển hướng về trang danh sách người dùng
            return redirect()->route('user');
        }

        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.userAdd', compact('userGroups'));
    }

    public function userEdit($id)
    {
        $user = $this->userModel->findOrFail($id);
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.userEdit', compact('user', 'userGroups'));
    }

    public function userUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'nullable |confirmed',
        ]);
        $user = $this->userModel->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->province = $request->province;
        $user->district = $request->district;
        $user->ward = $request->ward;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->user_group_id = $request->user_group_id;
        // Chỉ cập nhật mật khẩu nếu người dùng đã nhập mật khẩu mới
        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();

        // Lưu hình ảnh chính của sản phẩm
        if ($request->hasFile('image')) {
            // Lấy tên gốc của tệp
            $image = $request->file('image');

            $imageName = "{$user->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('uploads/'), $imageName);

            $user->image = $imageName;

            $user->save();
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $user->image = $user->image;
            $user->save();
        }

        return redirect()->route('user');
    }

    public function userDelete($id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->delete();
        return redirect()->route('user');
    }

    // user group
    public function userGroup()
    {
        $userGroups = $this->userGroupModel->userGroupAll();
        return view('admin.userGroup', compact('userGroups'));
    }

    public function userGroupEdit($id)
    {
        $userGroup = $this->userGroupModel->findOrFail($id);
        return view('admin.userGroupEdit', compact('userGroup'));
    }

    public function userGroupUpdate(Request $request, $id)
    {
        $userGroup = $this->userGroupModel->findOrFail($id);
        $userGroup->name = $request->name;
        $userGroup->save();
        return redirect()->route('admin.userGroup');
    }

    public function userGroupAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $validate = $request->validate([
                'name' => ['required'],
            ]);

            $this->userGroupModel->create($validate);

            return redirect()->route('admin.userGroup');
        }

        return view('admin.userGroupAdd');
    }

    public function userGroupDeleteCheckkbox(Request $request)
    {
        $userGroup_id = $request->input('userGroup_id');

        if ($userGroup_id) {
            foreach ($userGroup_id as $idUserGroup) {
                $userGroup = $this->userGroupModel->findOrFail($idUserGroup);
                if ($userGroup->id == 1) {
                    return redirect()->route('admin.userGroup')->with('danger', ' Cảnh báo: Nhóm khách hàng này không thể bị xóa vì nó hiện được chỉ định cho 1 khách hàng!');
                } else {
                    $userGroup->delete();
                }
            }
            return redirect()->route('admin.userGroup');
        }
    }

    // ĐƠN HÀNG
    public function order(Request $request)
    {
        $status_id = $request->input('status_id', 'all');
        $orders = $this->orderModel->orderAll();

        if ($status_id === 'all') {
            $orders = $this->orderModel->orderAll();
        } else {
            $orders = $this->orderModel->getOrderByStatus($status_id);
        }

        $productByOrder = [];
        foreach ($orders as $orderItem) {
            $productByOrder[$orderItem->id] = $this->orderProductModel->orderProductId($orderItem->id);
        }

        // Đếm số lượng đơn hàng theo trạng thái
        $countNew = $this->orderModel->countNew();
        $countProcessing = $this->orderModel->countProcessing();
        $countShipped = $this->orderModel->countShipped();
        $countCompleted = $this->orderModel->countCompleted();
        $countCancelled = $this->orderModel->countCancelled();

        $isSearching = false; // Biến trạng thái để kiểm tra xem có đang tìm kiếm hay không

        return view('admin.order', compact('orders', 'productByOrder', 'countNew', 'countProcessing', 'countShipped', 'countCompleted', 'countCancelled', 'isSearching'));
    }

    public function orderEdit($id)
    {
        $order = $this->orderModel->findOrFail($id);
        $orderStatuses = $this->orderStatus->getOrderStatus();
        $productByOrderEdit = $this->orderProductModel->orderProductEdit($id);
        $paymentMethod = $this->orderModel->getPaymentMethod();
        return view('admin.orderEdit', compact('order', 'productByOrderEdit', 'orderStatuses', 'paymentMethod'));
    }

    public function orderUpdate(Request $request, $id)
    {
        // Kiểm tra xem request gửi lên có chứa thông tin của orderproduct hay không
        if ($request->has('productByOrderEdit')) {
            // Nếu có, thực hiện cập nhật quantity của orderproduct
            foreach ($request->productByOrderEdit as $item) {
                $orderProduct = OrderProduct::where('order_id', $id)
                    ->where('product_id', $item['product_id'])
                    ->first();
                if ($orderProduct) {
                    // Cập nhật quantity của orderproduct
                    $orderProduct->quantity = $item['newQuantity'];
                    $orderProduct->total = $item['newTotalOrderProduct'];
                    $orderProduct->save();
                }
            }
        }

        // Tiếp tục xử lý cập nhật thông tin của đơn hàng
        $order = Order::findOrFail($id);
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->province = $request->province;
        $order->district = $request->district;
        $order->ward = $request->ward;
        $order->total = $request->total;
        $order->payment = $request->payment;
        $order->status_id = $request->status_id;
        //$order->total = (float)str_replace(',', '', $request->total); // Chuyển đổi chuỗi tiền tệ thành số
        //dd($order->toArray()); // Kiểm tra dữ liệu của đơn hàng trước khi lưu

        $order->save();

        return redirect()->route('admin.order');
    }

    // banner
    public function banner()
    {
        $banners = $this->bannerModel->bannerAll();
        $positionGet = $this->bannerModel->getPosition();
        return view('admin.banner', compact('banners', 'positionGet'));
    }

    public function bannerAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $banner = new Banner();
            $banner->name = $request->name;
            $banner->position = $request->position;
            $banner->status = $request->status;
            $banner->save();

            // Lưu các hình ảnh khác vào bảng ProductImage
            if ($request->hasFile('image')) {
                $imageList = $request->file('image');
                foreach ($imageList as $key => $image) {
                    $imageName = "{$banner->id}.{$key}.{$image->getClientOriginalExtension()}";

                    $image->move(public_path('uploads/'), $imageName);

                    $this->bannerImageModel->create([
                        'banner_id' => $banner->id,
                        'title' => $request->title,
                        'sort_order' => $request->sort_order,
                        'image' => $imageName,
                    ]);
                }
            }
            return redirect()->route('admin.banner');
        }

        $positionGet = $this->bannerModel->getPosition();

        return view('admin.bannerAdd', compact('positionGet'));
    }

    public function bannerEdit($id)
    {
        $banner = $this->bannerModel->findOrFail($id);
        $bannerImages = $this->bannerImageModel->bannerImageId($id);
        $positionGet = $this->bannerModel->getPosition();
        return view('admin.bannerEdit', compact('banner', 'bannerImages', 'positionGet'));
    }

    public function bannerUpdate(Request $request, $id)
    {
        $banner = $this->bannerModel->findOrFail($id);
        $banner->name = $request->name;
        $banner->position = $request->position;
        $banner->status = $request->status;
        $banner->save();

        if ($request->has('image')) {
            foreach ($request->file('image') as $key => $file) {
                $imagePath = $file->getClientOriginalName();
                $file->storeAs('public/uploads', $imagePath);
                $this->bannerImageModel->create([
                    'title' => $request->title[$key],
                    'image' => $imagePath,
                    'sort_order' => $request->sort_order[$key],
                ]);
            }
        } else {
            // foreach($request->banner_ids as $key => $valueId){
            //     $bannerImage = $this->bannerImageModel->findOrFail($valueId);
            //     if ($bannerImage) {
            //         $bannerImage->update([
            //             'title' => $request->title[$key],
            //             'sort_order' => $request->sort_order[$key]
            //         ]);
            //     }
            // }
        }

        return redirect()->route('admin.banner');
    }

    public function bannerDeleteCheckkbox(Request $request)
    {
        $banner_id = $request->input('banner_id');

        if ($banner_id) {
            foreach ($banner_id as $itemId) {
                $coupon = $this->bannerModel->findOrFail($itemId);
                $coupon->delete();
            }
        }
        return redirect()->route('admin.banner')->with('success', 'Xóa sản phẩm thành công.');
    }

    //comment
    public function comment()
    {
        $comments = $this->commentModel->commentAll();
        return view('admin.comment', compact('comments'));
    }
}
