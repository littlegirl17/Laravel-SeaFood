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
        foreach($dataFetch as $data){

            if($data['Id'] == $request->province){

                $provinceName = $data['Name'];

                // Lặp qua các huyện trong tỉnh để lấy tên huyện
                foreach($data['Districts'] as $district){

                    if($district['Id'] == $request->district){
                        $districtName = $district['Name'];

                        // Đi qua các phường của quận để lấy tên phường
                        foreach($district['Wards'] as $ward){

                            if($ward['Id'] == $request->ward){
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


        $incommingFields = $request->validate([
            'name'=>['required','min:3','max:10', Rule::unique('users','name')], //Rule::unique('users', 'name'): Đảm bảo rằng giá trị của 'name' là duy nhất trong bảng 'users'. Điều này ngăn chặn việc người dùng đăng ký với tên đã tồn tại trong hệ thống.
            'email'=>['required','email', Rule::unique('users','email')], //Rule::unique('users', 'email'): Đảm bảo rằng giá trị của 'email' là duy nhất trong bảng 'users'. Điều này ngăn chặn việc người dùng đăng ký với tên đã tồn tại trong hệ thống.
            'password'=>['required','min:8', 'max:200'],
            'province'=>['required'],
            'district' =>['required'],
            'ward' =>['required'],
            'phone'=>['required','numeric', 'digits:10', Rule::unique('users','phone')],

        ]);

        $incommingFields['province']=$provinceName;
        $incommingFields['district']=$districtName;
        $incommingFields['ward']=$wardName;

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

    // public function forgetPassword(Request $request){
    //     // dd($request->all());
    //     $count = $this->userModel->where('email', '=', $request->email)->count();

    //     if($count > 0){
    //         $user =  $this->userModel->where('email', '=', $request->email)->first();
    //         $user->remember_token = Str::random(50);
    //         $user->save();
    //         Mail::to($user->email)->send(new ForgotPasswordMail($user));
    //         return redirect()->back()->with('success', 'Hướng dẫn đặt lại mật khẩu đã được gửi đến email của bạn.');
    //     }else{
    //         return redirect()->back()->with('error', 'Email không có trong hệ thống');
    //     }
    // }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('/login');
    }

}