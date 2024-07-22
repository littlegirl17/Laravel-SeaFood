<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserGroup;
use App\Models\BannerImage;
use App\Models\OrderStatus;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\ProductDiscount;
use App\Models\AdministrationGroup;
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
    private $administrationModel;
    private $administrationGroupModel;

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
        $this->administrationModel = new Administration;
        $this->administrationGroupModel = new AdministrationGroup;
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

    public function searchOrder(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_iddh = $request->input('filter_iddh');
        $filter_userName = $request->input('filter_userName');
        $filter_total = $request->input('filter_total');
        $filter_status = $request->input('filter_status');

        $orders = $this->orderModel->searchOrder($filter_iddh, $filter_userName, $filter_total, $filter_status);

        $productByOrder = [];
        foreach ($orders as $orderItem) {
            $productByOrder[$orderItem->id] = $this->orderProductModel->orderProductId($orderItem->id);
        }

        $isSearching = true; // Biến trạng thái để kiểm tra xem có đang tìm kiếm hay không

        $orrderStatus = $this->orderStatus->all();
        return view('admin.order', compact('orders', 'orrderStatus', 'productByOrder', 'isSearching'));
    }

    public function searchComment(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_idsp = $request->input('filter_idsp');
        $filter_userName = $request->input('filter_userName');
        $filter_content = $request->input('filter_content');
        $filter_status = $request->input('filter_status');

        $comments = $this->commentModel->searchComment($filter_idsp, $filter_userName, $filter_content, $filter_status);
        $products = $this->productModel->all();
        return view('admin.comment', compact('comments', 'products', 'filter_userName', 'filter_content'));
    }

    public function searchUser(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_email = $request->input('filter_email');
        $filter_status = $request->input('filter_status');

        $users = $this->userModel->searchUser($filter_email, $filter_status);

        return view('admin.user', compact('users', 'filter_email'));
    }

    public function searchAdministration(Request $request)
    {
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $filter_name = $request->input('filter_name');
        $filter_adminGroupId = $request->input('filter_adminGroupId');

        $administrations = $this->administrationModel->searchAdministration($filter_adminGroupId, $filter_name);
        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administration', compact('administrations', 'administrationGroups', 'filter_name'));
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

            if (auth()->guard('admin')->attempt(['name' => $incommingFields['name'], 'password' => $incommingFields['password']])) {
                $request->session()->regenerate();
                $admin = auth()->guard('admin')->user();

                if ($admin->status >= 1) {
                    Session::put('admin', $admin);
                    return redirect('admin/dashboard')->with('success', 'Đăng nhập thành công');
                } else {
                    auth()->guard('admin')->logout();
                    return redirect()->back()->with(['danger' => 'Tài khoản của bạn đã bị khóa']);
                }
            } else {
                return redirect()->back()->with(['danger' => 'Tên đăng nhập hoặc mật khẩu bị sai!']);
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return redirect()->back()->with(['danger' => $error]);
        }
    }

    public function dashboard()
    {
        $countProduct = $this->productModel->countProduct();
        $countCategory = $this->categoryModel->countCategory();
        $countUser = $this->userModel->countUser();
        $countOrder = $this->orderModel->countOrder();

        // $countBlog = $this->blogModel->countBlog();

        // doanh số
        $totalRevenue = $this->orderModel->totalRevenue();
        return view('admin.dashboard', compact('totalRevenue', 'countProduct', 'countCategory', 'countUser', 'countOrder'));
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

                $countCategory = $this->productModel->countCategory($item);

                //nếu bảng product có category_id lớn hơn 0 thì ko cho xóa: nghĩa là nó đang có kết nối đến 1 bảng ghi trong bảng category
                if ($countCategory > 0) {
                    return redirect()->route('category')->with('danger', ' Cảnh báo: Nhóm danh mục này không thể bị xóa vì nó hiện được chỉ định cho ' . $countCategory . ' sản phẩm!');
                } else {
                    $category->delete();
                }
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

        // update nhiều hình ảnh và ảnh gốc
        $this->productUpdateImages($request, $product);

        //update luôn hàm của nhóm : chia ra dầy viết cho gọn
        $this->handleUpdate_ProductDiscount_userGroup($request, $product);

        $product->save();

        return redirect()->route('product')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function productUpdateImages($request, $product)
    {
        /// Lưu hình ảnh chính của sản phẩm product
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

        // nhiều hình ảnh productImages
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
                    }
                }
            }
        }
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

    public function deleteProductImages($product_id)
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

    public function couponUpdateStatus(Request $request, $id)
    {
        $coupon = $this->couponModel->findOrFail($id);
        $coupon->status = $request->status;
        $coupon->save();
        return response()->json(['success' => true]);
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

    public function userUpdateStatus(Request $request, $id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => true]);
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

                //count user_group_id trong bảng user
                $countUserGroup = $this->userModel->countUserGroup($idUserGroup);

                //nếu bảng user có user_group_id lớn hơn 0 thì ko cho xóa: nghĩa là nó đang có kết nối đến 1 bảng ghi trong bảng userGroup
                if ($countUserGroup > 0) {
                    return redirect()->route('admin.userGroup')->with('danger', ' Cảnh báo: Nhóm khách hàng này không thể bị xóa vì nó hiện được chỉ định cho ' . $countUserGroup . ' khách hàng!');
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

        $orrderStatus = $this->orderStatus->all();

        return view('admin.order', compact('orders', 'orrderStatus', 'productByOrder', 'countNew', 'countProcessing', 'countShipped', 'countCompleted', 'countCancelled', 'isSearching'));
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
        $order->total = (float)str_replace(',', '', $request->total); // Chuyển đổi chuỗi tiền tệ thành số
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

        $this->bannerUpdateImages($request, $banner);
        return redirect()->route('admin.banner');
    }

    public function bannerUpdateImages($request, $banner)
    {
        // kiểm tra xem có ảnh tải lên hay không
        if ($request->hasFile('image')) {

            // kiểm tra trong bảng bannerImages đã có ảnh chưa
            $bannerImages = $this->bannerImageModel->bannerImageId($banner->id);

            if (count($request->file('image'))) {

                //lấy danh sách ảnh được gửi lên từ request
                $imageList = $request->file('image');
                //Lặp qua danh sách các hình ảnh được tải lên.
                foreach ($imageList as $key => $img) {
                    // tạo ra một tên file cho ảnh được tải lên.
                    $imageName = "{$banner->id}.{$key}.{$img->getClientOriginalExtension()}";

                    //Di chuyển hình ảnh được tải lên vào thư mục public/uploads/ với tên tệp tin mới vừa tạo.
                    $img->move(public_path('uploads/'), $imageName);
                    //Tạo mới một bản ghi trong bảng bannerImages với các thông tin như banner_id, title, image, sort_order.
                    $this->bannerImageModel->create([
                        'banner_id' => $banner->id,
                        'title' => $request->title,
                        'image' => $imageName,
                        'sort_order' => $request->sort_order,
                    ]);
                }
            }
            //Lặp qua danh sách các hình ảnh hiện có.
            foreach ($bannerImages as $key => $item) {
                if ($request->hasFile("image.$key")) {
                    $newImage = $request->file("image.$key");
                    $imageName = "{$banner->id}.{$key}.{$newImage->getClientOriginalExtension()}";
                    $newImage->move(public_path('uploads/'), $imageName);
                    $item->image = $imageName;
                    $item->save();
                }
            }
        } else {
            // cập nhật tiêu đề và thứu tự, khi ko thay đổi hình ảnh
            $bannerImages = $this->bannerImageModel->bannerImageId($banner->id);
            foreach ($bannerImages as $key => $item) {
                $item->title = $request->title[$key];
                $item->sort_order = $request->sort_order[$key];
                $item->save();
            }
        }
    }

    public function bannerUpdateStatus(Request $request, $id)
    {
        $banner = $this->bannerModel->findOrFail($id);
        $banner->status = $request->status;
        $banner->save();
        return response()->json(['success' => true]);
    }

    public function bannerDeleteCheckkbox(Request $request)
    {
        $response = $this->administrationGroupCRUD();

        if ($response) {
            return $response;
        }
        $banner_id = $request->input('banner_id');

        if ($banner_id) {
            foreach ($banner_id as $itemId) {
                //xóa trong bảng banner
                $banner = $this->bannerModel->findOrFail($itemId);
                // khi xóa banner thì xóa luôn trong bảng bannerImages nếu nó có liên kết đến
                $this->bannerImageModel->where('banner_id', $itemId)->delete();
                $banner->delete();
            }
        }
        return redirect()->route('admin.banner')->with('success', 'Xóa sản phẩm thành công.');
    }

    public function deleteBannerImages($id)
    {
        $bannerImages = $this->bannerImageModel->findOrFail($id);
        $bannerImages->delete();
        return redirect()->back();
    }
    //comment
    public function comment()
    {
        $comments = $this->commentModel->commentAll();
        $products = $this->productModel->all();

        return view('admin.comment', compact('comments', 'products'));
    }

    public function commentUpdateStatus(Request $request, $id)
    {
        $comment = $this->commentModel->findOrFail($id);
        $comment->status = $request->status;
        $comment->save();
        return response()->json(['success' => true]);
    }

    public function commentDeleteCheckkbox(Request $request)
    {
        $comment_id = $request->input('comment_id');
        if ($comment_id) {
            foreach ($comment_id as $item) {
                $comment = $this->commentModel->findOrFail($item);
                $comment->delete();
            }
        }
        return redirect()->route('admin.comment')->with('success', 'Xóa bình luận thành công.');
    }

    public function commentDelete($id)
    {
        $comment = $this->commentModel->findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }

    // administration
    public function administration()
    {
        $administrations = $this->administrationModel->getAllAdmin();
        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administration', compact('administrations', 'administrationGroups'));
    }

    public function administrationAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'password' => 'nullable | confirmed',
            ]);

            $administration = $this->administrationModel;
            $administration->name = $request->name;
            $administration->admin_group_id  = $request->admin_group_id;
            $administration->fullname = $request->fullname;
            $administration->email = $request->email;
            $administration->image = '';
            $administration->status = $request->status;
            $administration->password =  bcrypt($validated['password']);
            $administration->save();

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imageName = "{$administration->id}.{$image->getClientOriginalExtension()}";

                $image->move(public_path('uploads/'), $imageName);

                $administration->image = $imageName;

                $administration->save();
            }


            return redirect()->route('administration')->with('success', 'Thêm người dùng thành công.');
        }

        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationAdd', compact('administrationGroups'));
    }

    public function administrationEdit($id)
    {
        $administration = $this->administrationModel->findOrFail($id);
        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationEdit', compact('administration', 'administrationGroups'));
    }

    public function administrationUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'nullable |confirmed',
        ]);

        $administration = $this->administrationModel->findOrFail($id);
        $administration->name = $request->name;
        $administration->admin_group_id  = $request->admin_group_id;
        $administration->fullname = $request->fullname;
        $administration->email = $request->email;
        $administration->image = '';
        $administration->status = $request->status;

        if ($request->filled('password')) {
            $administration->password =  bcrypt($validated['password']);
        }

        $administration->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = "{$administration->id}.{$image->getClientOriginalExtension()}";

            $image->move(public_path('uploads/'), $imageName);

            $administration->image = $imageName;

            $administration->save();
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $administration->image = $administration->image;
            $administration->save();
        }
        return redirect()->route('administration');
    }

    public function administrationDeleteCheckkbox(Request $request)
    {
        $administration_id = $request->input('administration_id');

        if ($administration_id) {
            foreach ($administration_id as $itemId) {
                $administration = $this->administrationModel->findOrFail($itemId);
                $administration->delete();
            }
        }
        return redirect()->route('administration')->with('success', 'Xóa người dùng thành công.');
    }

    // administration Group
    public function administrationGroup()
    {
        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationGroup', compact('administrationGroups'));
    }

    public function administrationGroupAdd(Request $request)
    {
        if ($request->isMethod('post')) {

            $administrationGroup = $this->administrationGroupModel;
            $administrationGroup->name = $request->name;
            $administrationGroup->permission = json_encode($request->permission);
            $administrationGroup->save();

            return redirect()->route('administrationGroup')->with('success', 'Thêm nhóm người dùng thành công.');
        }

        $administrationGroups = $this->administrationGroupModel->administrationGroupAll();
        return view('admin.administrationGroupAdd', compact('administrationGroups'));
    }

    public function administrationGroupEdit($id)
    {
        $administrationGroup = $this->administrationGroupModel->findOrFail($id);
        $permissionGroup = json_decode($administrationGroup->permission, true);
        return view('admin.administrationGroupEdit', compact('administrationGroup', 'permissionGroup'));
    }

    public function administrationGroupUpdate(Request $request, $id)
    {

        $administrationGroup = $this->administrationGroupModel->findOrFail($id);

        $administrationGroup->name = $request->name;
        $administrationGroup->permission = json_encode($request->permission);
        $administrationGroup->save();
        return redirect()->route('administrationGroup');
    }

    public function administrationGroupDeleteCheckkbox(Request $request)
    {
        $administrationGroup_id = $request->input('administrationGroup_id');

        if ($administrationGroup_id) {
            foreach ($administrationGroup_id as $itemId) {
                $administrationGroup = $this->administrationGroupModel->findOrFail($itemId);

                $countAdministrationGroup = $this->administrationModel->countAdministrationGroup($itemId);
                if ($countAdministrationGroup > 0) {
                    return redirect()->route('administrationGroup')->with('danger', ' Cảnh báo: Nhóm người dùng này không thể bị xóa vì nó hiện được chỉ định cho ' . $countAdministrationGroup . ' người dùng!');
                } else {
                    $administrationGroup->delete();
                    return redirect()->route('administrationGroup')->with('success', ' Thành công: Nhóm người dùng này đã được xóa');
                }
            }
        }
        return redirect()->route('administrationGroup')->with('success', 'Xóa nhóm người dùng thành công.');
    }

    public function administrationGroupCRUD()
    {
        $admin = auth()->guard('admin')->user();
        $permissions = json_decode($admin->administrationGroup->permission, true);
        if (array_search('bannerCheckboxDelete', $permissions) === false) {
            return redirect()->back()->with('danger', 'Bạn không có quyền xóa sản phẩm.');
        }
    }
}
