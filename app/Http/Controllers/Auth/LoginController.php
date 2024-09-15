<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
// use Str;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Hash;
// use Mail;

use Illuminate\Support\Facades\Mail;

// use Hash;
use App\Mail\ForgotPasswordMail;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('guest.index');
        } else {
            return view('guest.login');
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ];
        if (Auth::attempt($credentials)) {
            if (Auth::id()) {
                $userlevel = Auth()->user()->level;
                if ($userlevel == 1) {
                    return redirect()->route('index');
                } else if ($userlevel == 2) {
                    return redirect()->route('admin.index');
                } else {
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->back()->with('Có lỗi xảy ra', 'Email hoặc Password không đúng, vui lòng nhập lại.');
        }
    }
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('guest.register');
    }

    public function register(registerRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->save();

        return redirect()->route('showLogin');
    }

    public function showForgotPassword()
    {
        return view('guest.forgotPassword');
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $count = User::where('email', $request->email)->count();
        if ($count > 0) {
            $user = User::where('email', $request->email)->first();
            $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('Chúc mừng', 'Mail kích hoạt lại mật khẩu đã được gửi, vui lòng kiểm tra email của bạn.');
        } else {
            return redirect()->back()->with('Có lỗi xảy ra', 'Email chưa đăng ký thành viên, vui lòng đăng ký tài khoản mới.');
        }
    }
    public function resetPassword($token)
    {
        $jsonString = User::select('email')->where('remember_token', $token)->first();
        $email = $jsonString->email;
        return view('guest.newPassword', compact('token', 'email'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            "password" => "required|string|confirmed",
            "password_confirmation" => "required"
        ]);
        $updatePass = User::where("remember_token", $request->token)->get();
        if (!$updatePass) {
            return redirect()->to(route('forget.password'))->with('Có lỗi xảy ra', 'Cập nhật mật khẩu thất bại.');
        }

        User::where("remember_token", $request->token)
            ->update(["password" => Hash::make($request->password)]);
        return redirect()->to(route('showLogin'))->with("Chúc mừng", "Mật khẩu đã được cập nhật thành công.");
    }
}
