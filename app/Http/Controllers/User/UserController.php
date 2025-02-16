<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use DB;
class UserController extends Controller
{
    // Hiển thị form đăng nhập người dùng
    public function index()
    {
        return view('user.login');
    }

    // Hiển thị form đăng ký người dùng
    public function signUpForm()
    {
        return view('user.register');
    }

    // Xử lý đăng nhập
    public function loginUser(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:3',
        ]);
    
        // Thử đăng nhập
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }
    
        // Đăng nhập thất bại
        return back()->withErrors([
            'name' => 'Tên tài khoản hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('name'));
    }
    
 
    // Xử lý đăng ký người dùng
    public function signUpUser(Request $request)
    {
        // Validate dữ liệu trực tiếp từ Request
        $request->validate([
            'email' => 'required|email|unique:users,email',  // Kiểm tra email có tồn tại chưa
            'name' => 'required|string|max:255',  // Kiểm tra tên người dùng
            'password' => 'required|min:3|confirmed',  // Mật khẩu yêu cầu tối thiểu 3 ký tự và có xác nhận
        ], [
            'email.unique' => 'Email đăng ký đã tồn tại!',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp!',
            'password.min' => 'Mật khẩu ít nhất phải có 3 ký tự!',
        ]);

        try {
            // Tạo người dùng mới
            $user = new User;
            $user->name = $request->name;  // Lưu tên người dùng
            $user->email = $request->email;  // Lưu email
            $user->password = Hash::make($request->password);  // Mã hóa mật khẩu
            $user->save();  // Lưu người dùng vào cơ sở dữ liệu

            // Đăng nhập ngay sau khi đăng ký thành công
            // Auth::login($user);

            // Quay lại trang chủ sau khi đăng ký và đăng nhập
            return redirect()->back()->with('success', 'Đăng ký tài khoản thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, quay lại với thông báo lỗi
            return back()->with('toast_error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }
    }

    // Đăng xuất người dùng
    public function logoutUser()
    {
        auth()->logout(); 
        return redirect()->route('login')->with('success', 'Đã đăng xuất thành công.');
    }
}
