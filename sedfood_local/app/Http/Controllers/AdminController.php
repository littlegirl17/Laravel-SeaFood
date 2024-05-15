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
use Illuminate\Support\Facades\Session;

class AdminController extends Controller {
    private $categoryModel;
    private $productModel;
    private $commentModel;
    private $orderModel;
    private $userModel;


    public function __construct(){
        $this->categoryModel = new Category;
        $this->productModel = new Product;
        $this->commentModel = new Comment;
        $this->orderModel = new Order;
        $this->userModel = new User;
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

    public function product(){
        $products = $this->productModel->productAll();
        return view('admin.product', compact('products'));
    }

    public function user(){
        $users = $this->userModel->userAll();
        return view('admin.user', compact('users'));
    }

    public function comment(){
        $comments = $this->commentModel->commentAll();
        return view('admin.comment', compact('comments'));
    }
}
