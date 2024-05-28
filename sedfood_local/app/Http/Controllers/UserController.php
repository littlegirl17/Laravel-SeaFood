<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\ForgotPasswordMail;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userModel;


    public function __construct(){
        $this->userModel = new User;

    }

    public function register(Request $request){

        // Fetch data from API
        $response = Http::get('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json');

        $dataFetch = $response->json();

        $provinceName = '';
        $districtName = '';
        $wardName = '';

    // Lặp qua dữ liệu để lấy tên tỉnh
        // foreach($dataFetch as $data){

        //     if($data['Id'] == $request->province){

        //         $provinceName = $data['Name'];

        //         // Lặp qua các huyện trong tỉnh để lấy tên huyện
        //         foreach($data['Districts'] as $district){

        //             if($district['Id'] == $request->district){
        //                 $districtName = $district['Name'];

        //                 // Đi qua các phường của quận để lấy tên phường
        //                 foreach($district['Wards'] as $ward){

        //                     if($ward['Id'] == $request->ward){
        //                         $wardName = $ward['Name'];
        //                         break;
        //                     }
        //                 }
        //                 break;
        //             }
        //         }
        //         break;
        //     }
    // }


        $incommingFields = $request->validate([
            'name'=>['required','min:3','max:10', Rule::unique('users','name')], //Rule::unique('users', 'name'): Đảm bảo rằng giá trị của 'name' là duy nhất trong bảng 'users'. Điều này ngăn chặn việc người dùng đăng ký với tên đã tồn tại trong hệ thống.
            'email'=>['required','email', Rule::unique('users','email')], //Rule::unique('users', 'email'): Đảm bảo rằng giá trị của 'email' là duy nhất trong bảng 'users'. Điều này ngăn chặn việc người dùng đăng ký với tên đã tồn tại trong hệ thống.
            'password'=>['required','min:8', 'max:200'],
            'phone'=>['required','numeric', 'digits:10', Rule::unique('users','phone')],

        ]);

        //băm password
        $incommingFields['password'] = bcrypt($incommingFields['password']);

        //tạo một bản ghi mới trong bảng users
        $user = User::create($incommingFields);
        //auth()->login($user);
        return redirect('/');
    }

    public function login(LoginRequest $request){

        $incommingFields = $request->validated();

        if(auth()->attempt(['name' => $incommingFields['name'], 'password' => $incommingFields['password']])){
            $request->session()->regenerate(); //Laravel sẽ tạo ra một phiên làm việc mới, và tất cả các dữ liệu trong phiên làm việc cũ sẽ không còn có hiệu lực nữa.

            $user = auth()->user();

            if($user->status == 0){
                auth()->logout();
                return redirect('/login')->with('danger', 'Tài khoản của bạn đã bị khóa');
            }else{
                if($user->role == 0){
                    //Lưu thông tin user vào session
                    Session::put('user', auth()->user());
                    return redirect('/')->with('success', 'Đăng nhập thành công');
                }else{
                    Session::put('user', auth()->user());
                    return redirect('admin/dashboard');
                }
            }
        }else{
            return redirect('/login')->withErrors(['danger'=> 'Username hoặc password đã sai! Vui lòng nhập lại']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('/login');
    }

    public function forgetPassword(Request $request){
        $request->validate(['email' => 'required | email | exists:users,email']);

        $code = rand(100000, 999999); //tạo một số ngẫu nhiên trong khoảng từ 100000 đến 999999.

        $user = $this->userModel->getCheckEmail($request->email); //sẽ tìm và trả về thông tin người dùng có email tương ứng.

        $user->verification_code = $code;

        $user->save();//Lưu mã xác thực vào cơ sở dữ liệu

        //Gửi email chứa mã xác thực
        Mail::send('mail.verificationCode',['code' => $code], function ($message) use ($user) {
            //gửi tới email đấy
            $message->to($user->email); //Địa chỉ email của người nhận
            $message->subject('Mã xác nhận đặt lại mật khẩu');
        });

        return redirect()->route('verify-code')->with('email', $request->email);
    }

    //Xác minh mã code T hay F
    public function verifyCode(Request $request) {
        $request->validate([
            'verification_code' => 'required',
            'email' => 'required | email | exists:users,email'
        ]);

        $user = $this->userModel->getCheckEmail($request->email);

        if($user->verification_code == $request->verification_code){
            return redirect()->route('reset-password')->with('email',$request->email);
        }else{
            return redirect()->route('verify-code')->with('error', 'Mã xác nhận không hợp lệ');
        }
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = $this->userModel->getCheckEmail($request->email);

        $user->password = bcrypt($request->password);

        $user->verification_code = null; // Xóa mã xác nhận sau khi đặt lại mật khẩu, vì mã code thường được sử dụng một lần

        $user->save();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công. Vui lòng đăng nhập.');
    }

}