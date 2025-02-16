<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (auth()->check()){
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:3',
        ]);

        $remember = $request->has('remember_me') ? true : false;

        if (auth()->attempt([
            'name' => $request->name,
            'password' => $request->password
        ], $remember)) {
            $user = auth()->user();
            if ($user->roles()->exists()) {
                return redirect()->to('home')->with('success', 'Đăng nhập thành công!');
            } else {
                auth()->logout();
                return redirect()->route('403');
            }
        }

        // Trả lại thông báo lỗi nếu đăng nhập thất bại
        return back()->withErrors([
            'loginError' => 'Tên tài khoản hoặc mật khẩu không chính xác.'
        ])->withInput(); // withInput() giữ lại dữ liệu đã nhập
    }

    public function logoutAdmin()  
    {
        auth()->logout(); // Đăng xuất người dùng hiện tại
        return redirect()->to('/admin'); // Điều hướng về trang đăng nhập
    }
}