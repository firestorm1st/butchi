<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Emotion;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function showPencil()
    {
        //return view('client.modules.pencil');
    }

    public function pencil(Request $request)
    {
        // return view('client.modules.pencil');
    }

    public function showCheckin()
    {
        //return view('client.modules.checkin');
    }

    public function checkin(Request $request)
    {
        // return view('client.modules.checkin');
    }

    public function room()
    {
        return view('client.room');
    }

    public function showAccount($id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }


        // Lấy dữ liệu cho 7 ngày gần nhất
        $data = Emotion::where('user_id', $id)->where('date', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->orderBy('date')
            ->get(['date', 'emo_id']); // Thay đổi theo cấu trúc bảng của bạn

        // return response()->json($data);

        // return view('client.accountPage', ['user' => $user, 'id' => $id]);

        // if (request()->wantsJson()) {
        //     return response()->json($data);

        // }
        // dd($data);
        // Trả về trang view nếu là yêu cầu thông thường (non-AJAX)
        return view('client.accountPage', [
            'user' => $user,
            'id' => $id,  // Thông tin người dùng
            'data' => $data    // Dữ liệu Emotion để hiển thị
        ]);
    }

    public function account(Request $request, string $id)
    {

        $user = User::where('id', $id)->first();

        $request->validate([
            'image' => 'mimes:jpg,png,bmp,jpeg',
        ]);

        $avatar = $request->avatar;
        if (!empty($avatar)) {
            if ($user->avatar) {
                $old_image_path = public_path('uploads/' . $user->avatar);
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/'), $avatarName);
            $user->avatar = $avatarName;
        }

        $user->username = $request->username;
        $user->password = bcrypt($request->password);

        $user->update();
        // dd($user);
        
        return redirect()->route('client.showAccount', ['user' => $user, 'id' => $id])->with('success', 'Cập nhật thông tin người dùng thành công.');
    }

    public function changeAccount(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('client.changeAccount', ['user' => $user, 'id' => $id]);
    }

    public function chart() {
        $data = Emotion::where('date', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->orderBy('date')
            ->get(['date', 'emo_id']); 
           
        return view('client.chart', [
            'data' => $data
        ]);
    }
}
