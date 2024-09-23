<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\EmotionDaily;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function showAccount($id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }

        $emotions = Emotion::orderBy('id', 'desc')->get();
        

        $data = EmotionDaily::where('user_id', $id)->where('date', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->orderBy('date')
            ->join('levels', 'emotion_daily.level_id', '=', 'levels.id')
            ->get(['date', 'emo_id','levels.name as level_name']); // Thay đổi theo cấu trúc bảng của bạn

        return view('client.accountPage', [
            'user' => $user,
            'id' => $id,  // Thông tin người dùng
            'data' => $data,    // Dữ liệu Emotion để hiển thị
            'emotions' => $emotions
        ]);
    }

    public function account(Request $request, string $id)
    {

        $user = User::where('id', $id)->first();

        $request->validate([
            'image' => 'mimes:jpg,png,bmp,jpeg',
            'username'=>'max:15'
        ],[
            'image.mimes' => 'Chỉ chấp nhận các định dạng hình ảnh: jpg, png, bmp, jpeg.',
            'username.max' => 'Tên người dùng không được vượt quá 15 ký tự.',
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
            $avatar->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/', $avatarName);
            $user->avatar = $avatarName;
        }

        $user->username = $request->username;
        $user->password = bcrypt($request->password);

        if($user->update()){
            return redirect()->route('client.showAccount', ['user' => $user, 'id' => $id])->with('success', 'Cập nhật thông tin người dùng thành công.');
        }
        // dd($user);

        return redirect()->back()->with('error', 'Có lỗi phát sinh');
    }

    public function changeAccount(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('client.changeAccount', ['user' => $user, 'id' => $id]);
    }

    public function chart()
    {
        $data = Emotion::where('date', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->orderBy('date')
            ->get(['date', 'emo_id']);

        return view('client.chart', [
            'data' => $data
        ]);
    }
}
