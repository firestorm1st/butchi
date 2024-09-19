<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use Hash;
use Illuminate\Http\Request;
use App\Models\Emotion;
use App\Models\EmotionDaily;
use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index($id)
    {
        $room = Room::findOrFail($id);  // Tìm phòng theo ID

        // Kiểm tra xem user có thuộc phòng này không
        if (auth()->user()->room_id !== $room->id) {
            return redirect()->route('client.rooms.enter', ['id' => $room->id])->withErrors(['error' => 'Bạn chưa nhập mật khẩu phòng này']);
        }

        // Truyền dữ liệu phòng vào view
        return view('client.index', ['room' => $room]);
    }

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

    public function storeRoom(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:10',
            'password' => 'required|string|confirmed', // Confirm password validation
        ]);

        // Create a new room
        $room = new Room();
        $room->name = $request->name;
        $room->password = bcrypt($request->password);

        if ($room->save()) {
            // Associate the room with the user
            $user->room_id = $room->id;
            $user->save();

            return redirect()->route('client.index', ['id' => $room->id])->with('success', 'Phòng đã được tạo thành công');
        }

        // Redirect to the client index page with an error message if saving fails
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }


    public function showRooms()
    {
        $rooms = Room::where('status', 1)->get();
        return view('client.room', compact('rooms'));
    }

    public function enterRoom(Request $request, $id)
    {
        $room = Room::find($id);  // Tìm thông tin phòng theo ID
        $password = $request->input('password');

        if ($room && Hash::check($password, $room->password)) {
            // Gán room_id cho user hiện tại
            $user = auth()->user();
            $user->room_id = $room->id;
            $user->save();

            // Chuyển hướng đến trang client/index/{id}
            return redirect()->route('client.emotion.form', ['id' => $room->id]);
        }

        // Nếu mật khẩu sai, quay lại modal với thông báo lỗi
        return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
    }

    public function showEmotionForm($room_id)
    {
        $user = auth()->user();
        $today = now()->startOfDay();
        $room = Room::find($room_id);
        // Lấy danh sách cảm xúc và mức độ
        $emotions = Emotion::all();
        $levels = Level::all();
        $answer=EmotionDaily::all();
    // Kiểm tra xem user đã gửi dữ liệu trong ngày chưa
    $emotionToday = EmotionDaily::where('user_id', $user->id)
    ->whereDate('created_at', $today)
    ->first();

    // Trả về view kèm theo thông tin
    return view('client.emoChoose', compact('emotions', 'levels', 'emotionToday','room','answer'));    
    }

    public function saveEmotionDaily(Request $request, $room_id)
    {
        // Lấy thông tin từ form gửi lên
        $emotion_id = $request->input('emotion_id');
        $level_id = $request->input('level_id');
        $user_id = auth()->id(); // Lấy id người dùng hiện tại
        $answer=$request->input('answer');
        $today = now()->startOfDay();
        $existingEmotion = EmotionDaily::where('user_id', $user_id)
                                   ->whereDate('created_at', $today)
                                   ->first();
        if ($existingEmotion) {
            return redirect()->back()->with('error', 'Bạn đã gửi cảm xúc hôm nay rồi.');
        }elseif(EmotionDaily::create([
            'user_id' => $user_id,
            'room_id' => $room_id,
            'emo_id' => $emotion_id,
            'level_id' => $level_id,
            'answer' => $answer
        ])){
            return redirect()->back()->with('success', 'Cảm xúc của bạn đã được lưu!');
        }

        // Chuyển hướng về trang cũ hoặc bất kỳ trang nào khác
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
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
