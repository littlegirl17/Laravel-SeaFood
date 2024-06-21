<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //lấy danh sách các bình luận cho một sản phẩm cụ thể
    public function comment($product_id){
        $getComment = Comment::where('product_id',$product_id)->join('users','users.id','=','user_id')->select('comments.*','users.name AS user_fullname','users.image AS user_image')->get();
        $kq = [
            'status' =>true,
            'message' => 'Lấy dữ liệu thành công',
            'data'=>$getComment
        ];

        return response()->json($kq,200);

    }

    /**
     * sử dụng để hiển thị danh sách các tài nguyên (ví dụ: các bình luận).
     */
    public function index()
    {
        //
    }

    /**
     * được sử dụng để hiển thị biểu mẫu tạo mới một tài nguyên.
     */
    public function create()
    {
        //
    }

    /**
     * Phương thức này lưu một bình luận mới vào cơ sở dữ liệu POST
     */
    public function store(Request $request)
    {
        // POST
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->content = $request->content;
        $comment->rating = $request->rating;
        $comment->save();
        $kq=[
            'status' =>true,
            'message' => 'Đã thêm bình luận'
        ];
        return response()->json($kq,200);
    }

    /**
     *  sử dụng để hiển thị một tài nguyên cụ thể dựa trên ID
     */
    public function show(string $id)
    {
        //
    }

    /**
     * sử dụng để hiển thị biểu mẫu chỉnh sửa một tài nguyên cụ thể dựa trên ID.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * sử dụng để cập nhật một tài nguyên cụ thể dựa trên ID và dữ liệu từ yêu cầu HTTP.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     *  sử dụng để xóa một tài nguyên cụ thể dựa trên ID.
     */
    public function destroy(string $id)
    {
        //
    }
}