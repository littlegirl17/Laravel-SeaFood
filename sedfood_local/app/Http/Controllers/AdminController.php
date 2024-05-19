<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller {
    private $categoryModel;
    private $productModel;
    private $commentModel;
    private $orderModel;
    private $userModel;
    private $productImage;

    public function __construct(){
        $this->categoryModel = new Category;
        $this->productModel = new Product;
        $this->productImage = new ProductImage;
        $this->commentModel = new Comment;
        $this->orderModel = new Order;
        $this->userModel = new User;
    }

    public function search(Request $request){
        //Lấy từ khóa tìm kiếm từ yêu cầu
        $search = $request->input('search');

        $categorys = $this->categoryModel->search($search);

        return view('admin.category', compact('categorys'));
    }


    public function manage(Request $request){
        try {

            $incommingFields = $request->validate([
                'name' => 'required',
                'password' => 'required'
            ]);

            if(auth()->attempt(['name' => $incommingFields['name'], 'password' => $incommingFields['password']])){
                $request->session()->regenerate(); //Laravel sẽ tạo ra một phiên làm việc mới, và tất cả các dữ liệu trong phiên làm việc cũ sẽ không còn có hiệu lực nữa.

                $role = auth()->user()->role;

                if($role >= 1){
                    //Lưu thông tin user vào session
                    Session::put('user', auth()->user());
                    return redirect('admin/dashboard')->with('success', 'Đăng nhập thành công');
                }

            }else{
                return redirect('/')->withErrors(['danger'=> 'Đăng nhập thất bại']);
            }

        } catch (\Throwable $th) {
            //return redirect()->back()->withErrors(['login' => 'Lỗi trong quá trình đăng nhập vui lòng thử lại'.$th->getMessage()]);
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    // category
        public function category(){
            $categorys = $this->categoryModel->categoryAll();

            return view('admin.category', compact('categorys'));
        }

        public function categoryAdd(Request $request){
            if($request->isMethod('post')){
                $validated = $request->validate([
                    'name' => ['required', 'max:255'],
                    'slug' => ['required', 'max:255'],
                    'image' => ['sometimes', 'image', 'max:208'], // 'sometimes' dùng để xác thực ảnh chỉ khi nó tồn tại
                    'status' => ['required','integer', Rule::in(0,1)], // Kiểm tra giá trị là số nguyên và chỉ chấp nhận 0 hoặc 1
                ]);

                if($request->hasFile('image')){
                    // Lấy tên gốc của tệp
                    $imagePath = $request->file('image')->getClientOriginalName();
                    // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                    $request->file('image')->storeAs('public/uploads',$imagePath);
                    // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                    $validated['image'] = $imagePath;
                }

                $this->categoryModel->create($validated);
                return redirect()->route('category');
            }
            return view('admin.categoryAdd');

        }

        public function categoryEdit($id){
            $category = $this->categoryModel->findOrFail($id);
            return view('admin.categoryEdit', compact('category'));
        }

        public function categoryUpdate(Request $request,$id){
            $validated = $request->validate([
                'name' => ['required', 'max:255'],
                'slug' => ['required', 'max:255'],
                'image' => ['sometimes', 'image', 'max:208'], // 'sometimes' dùng để xác thực ảnh chỉ khi nó tồn tại
                'status' => ['required','integer', Rule::in(0,1)], // Kiểm tra giá trị là số nguyên và chỉ chấp nhận 0 hoặc 1
            ]);
            //dd($validated);
            if($request->hasFile('image')){
                // Lấy tên gốc của tệp
                $imagePath = $request->file('image')->getClientOriginalName();
                // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                $request->file('image')->storeAs('public/uploads',$imagePath);
                // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                $validated['image'] = $imagePath;
            }

            $category = $this->categoryModel->findOrFail($id);
            $category->update($validated);
            return redirect()->route('category');
        }

        public function categoryDelete($id){
            $category = $this->categoryModel->findOrFail($id);
            $category->delete();
            return redirect()->route('category');
        }

    // product
        public function product(){
            $products = $this->productModel->productAll();
            return view('admin.product', compact('products'));
        }

        public function productAdd(Request $request){
            if($request->isMethod('post')){
                $validated = $request->validate([
                    'name' => ['required', 'max:255'],
                    'slug' => ['required', 'max:255'],
                    'description' => ['required', 'string'],
                    'category_id' => ['required', 'integer', 'exists:products,category_id'],  //Giá trị của category_id phải tồn tại trong bảng categories và cột category_id.
                    'price' => ['required', 'integer'],
                    'discount_price' => ['required', 'integer'],
                    'view' => ['required', 'integer'],
                    'outstanding' => ['required', 'string'],
                    'image' => ['sometimes', 'image', 'max:208'], // 'sometimes' dùng để xác thực ảnh chỉ khi nó tồn
                    'status' => ['required','integer', Rule::in([0, 1])], // Kiểm tra giá trị là số nguyên và chỉ chấp nhận 0 hoặc 1
                ]);

                // Lưu hình ảnh chính của sản phẩm
                if($request->hasFile('image')){
                    // Lấy tên gốc của tệp
                    $imagePath = $request->file('image')->getClientOriginalName();
                    // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                    $request->file('image')->storeAs('public/uploads',$imagePath);
                    // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                    $validated['image'] = $imagePath;
                }

                $product =$this->productModel->create($validated);

                // Lưu các hình ảnh khác vào bảng ProductImage
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $file) {
                        $imagePath = $file->getClientOriginalName();
                        $file->storeAs('public/uploads', $imagePath);
                        $this->productImage->create([
                            'product_id' => $product->id,
                            'images' => $imagePath,
                        ]);
                    }
                }
                return redirect()->route('product');
            }
            $category = $this->categoryModel->all();
            return view('admin.productAdd', compact('category'));

        }

        public function productEdit($id){
            $product = $this->productModel->findOrFail($id);
            $category = $this->categoryModel->all();
            $productImages = $this->productImage->productImages($id);
            return view('admin.productEdit', compact('product','category','productImages'));
        }

        public function productUpdate(Request $request,$id){

            $product = $this->productModel->findOrFail($id);
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->view = $request->view;
            $product->outstanding = $request->outstanding;
            $product->status = $request->status;

            $imagePath = null;
            if($request->hasFile('image')){
                // Lấy tên gốc của tệp
                $imagePath = $request->file('image')->getClientOriginalName();
                // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                $request->file('image')->storeAs('public/uploads',$imagePath);
                // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                $product->image = $imagePath;


            }
                $product->update();

                // Cập nhật bảng ProductImage
                if ($request->hasFile('images')) { // kiểm tra xem liệu có tệp hình ảnh mới nào được gửi trong yêu cầu không
                    $productImages = $this->productImage->productImages($id); // lấy danh sách các hình ảnh của product cụ thể thông qua id

                    if ($productImages->isEmpty()) { // nếu sản phẩm chưa có ảnh phụ
                        foreach ($request->file('images') as $key => $image) {
                            $imagePath = $image->getClientOriginalName();
                            $image->storeAs('public/uploads', $imagePath);
                            $this->productImage->create([
                                'product_id' => $product->id,
                                'images' => $imagePath,
                            ]);
                        }
                    } else { // nếu sản phẩm đã có ảnh phụ
                        //Lặp qua các hình ảnh hiện tại:
                        foreach ($productImages as $key => $item) {
                            //kiểm tra xem liệu có tệp hình ảnh mới nào được tải lên cho hình ảnh hiện tại không.
                            if ($request->hasFile("images.$key")) {
                                $imagePath = $request->file("images.$key")->getClientOriginalName();
                                $request->file("images.$key")->storeAs('public/uploads', $imagePath);
                                $item->images = $imagePath;
                                $item->update();
                            }else if($request->has("delete_image.$key")){
                                $item->delete();
                            }
                        }
                    }
                }


            return redirect()->route('product');
        }

        public function productDelete($id){
            $product = $this->productModel->findOrFail($id);
            $productImages = $this->productImage->productImages($id);
            foreach ($productImages as $item) {
                $item->delete();
            }

            $product->delete();
            return redirect()->route('product');
        }

        public function deleteImages($id,$product_id){
            $productImages = $this->productImage->findOrFail($product_id);
            $productImages->delete();
            return redirect()->back();
        }

    // user
        public function user(){
            $users = $this->userModel->userAll();
            return view('admin.user', compact('users'));
        }
        public function userAdd(Request $request)
        {
            if ($request->isMethod('post')) {
                // Validate dữ liệu đầu vào
                $validated = $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'phone' => 'required',
                    'province' => 'required',
                    'district' => 'required',
                    'ward' => 'required',
                    'role' => 'required',
                    'status' => 'required',
                ]);

                // Xử lý mật khẩu
                $validated['password'] = bcrypt($request->password);

                // Xử lý hình ảnh nếu có
                if ($request->hasFile('image')) {
                    // Lấy tên gốc của tệp
                    $imagePath = $request->file('image')->getClientOriginalName();
                    // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                    $request->file('image')->storeAs('public/uploads', $imagePath);
                    // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                    $validated['image'] = $imagePath;
                }

                // Tạo người dùng mới
                $this->userModel->create($validated);

                // Chuyển hướng về trang danh sách người dùng
                return redirect()->route('user');
            }

            return view('admin.userAdd');
        }


        public function userEdit($id){
            $user = $this->userModel->findOrFail($id);
            return view('admin.userEdit', compact('user'));
        }

        public function userUpdate(Request $request,$id){

            $user = $this->userModel->findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->phone = $request->phone;
            $user->province = $request->province;
            $user->district = $request->district;
            $user->ward = $request->ward;
            $user->role = $request->role;
            $user->status = $request->status;

            $imagePath = null;
            if($request->hasFile('image')){
                // Lấy tên gốc của tệp
                $imagePath = $request->file('image')->getClientOriginalName();
                // Lưu tệp vào thư mục 'public/uploads' với tên gốc
                $request->file('image')->storeAs('public/uploads',$imagePath);
                // Lưu đường dẫn của hình ảnh vào mảng đã xác thực
                $user->image = $imagePath;
            }
                $user->update();

            return redirect()->route('user');
        }

        public function userDelete($id){
            $user = $this->userModel->findOrFail($id);
            $user->delete();
            return redirect()->route('user');
        }


    public function comment(){
        $comments = $this->commentModel->commentAll();
        return view('admin.comment', compact('comments'));
    }
}