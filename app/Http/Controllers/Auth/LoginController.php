<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
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
            // 'status' => 1,
        ];
        if (Auth::attempt($credentials)) {
            if (Auth::id()) {
                $userlevel = Auth()->user()->role;
                if ($userlevel == 1) {
                    return redirect()->route('guest.index');
                } else if ($userlevel == 3) {
                    return redirect()->route('admin.index');
                } else if($userlevel == 2){
                    return redirect()->route('guest.index');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Email hoặc Password không đúng, vui lòng nhập lại.');
        }
    }
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('guest.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $is_offline = $request->has('is_offline') ? 1 : 2;
        $user->is_offline=$is_offline;
        $user->role=$request->role;
        if($user->save()){
            Auth::login($user);
            return redirect()->route('showLogin')->with('success','Đăng kí thành công');
        }
        return redirect()->back()->with('error','Có lỗi xảy ra');
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

            return redirect()->back()->with('success', 'Mail kích hoạt lại mật khẩu đã được gửi, vui lòng kiểm tra email của bạn.');
        } else {
            return redirect()->back()->with('error', 'Email chưa đăng ký thành viên, vui lòng đăng ký tài khoản mới.');
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
        ],[
            'password.required:Bạn phải nhập mật khẩu',
            'password_confirmation.required:Bạn phải nhập mật khẩu xác nhận'
        ]);
        $updatePass = User::where("remember_token", $request->token)->get();
        if (!$updatePass) {
            return redirect()->to(route('forget.password'))->with('error', 'Cập nhật mật khẩu thất bại.');
        }

        User::where("remember_token", $request->token)
            ->update(["password" => Hash::make($request->password)]);
        return redirect()->to(route('showLogin'))->with("success", "Mật khẩu đã được cập nhật thành công.");
    }
}
