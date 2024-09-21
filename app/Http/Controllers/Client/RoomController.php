<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\EmotionDaily;
use App\Models\Emotion;
use App\Models\Level;

class RoomController extends Controller
{
    public function showFullEmo($roomId) {
        $room = Room::findOrFail($roomId); 
        // Lấy danh sách cảm xúc hàng ngày từ bảng EmotionDaily theo room_id
        $emotions = EmotionDaily::with(['user', 'emotion', 'level'])
                    ->whereHas('user', function ($query) use ($roomId) {
                        $query->where('room_id', $roomId);
                    })
                    ->get();
    
        return view('client.emoIndex', ['rooms'=>$room,'emotions' => $emotions]);
    }

    public function index(string $id)
    {
        $room = Room::findOrFail($id);  // Tìm phòng theo ID

        // Kiểm tra xem user có thuộc phòng này không
        if (auth()->user()->room_id !== $room->id) {
            return redirect()->route('client.rooms.enter', ['id' => $room->id])->withErrors(['error' => 'Bạn chưa nhập mật khẩu phòng này']);
        }

        // Truyền dữ liệu phòng vào view
        return view('client.index', ['id' => $id]);
    }

    public function storeRoom(Request $request)
    {
        $user = Auth::user();

        // Check if the user has already created a room
        $roomExists = Room::where('user_id', $user->id)->exists();

        if ($roomExists) {
            return redirect()->back()->with('error', 'Bạn đã tạo phòng, xin vui lòng đăng nhập vào phòng của mình');
        }else{
            $request->validate([
                'name' => 'required|string|max:8',
                'password' => 'required|string|confirmed', // Confirm password validation
            ],[
                'name.requied:Tên phòng cần được điền',
                'name.max:Tên phòng không được quá 8 kí tự',
                'password.required:Phải điền mật khẩu',
                'password.confirmed:bạn phải nhập mật khẩu xác nhận'
            ]);
    
            // Create a new room
            
            $room = new Room();
            $room->user_id = $user->id;
            $room->name = $request->name;
            $room->password = bcrypt($request->password);
    
            if ($room->save()) {
                // Associate the room with the user
                $user->room_id = $room->id;
                $user->save();
    
                return redirect()->route('client.index', ['id' => $room->id])->with('success', 'Phòng đã được tạo thành công');
            }
    
            // Redirect to the client index page with an error message if saving fails
            return redirect()->back()->with('error', 'Tên phòng dưới 8 chữ hoặc phải nhập mật khẩu');
        }

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
            return redirect()->route('client.index', ['id' => $room->id])->with('success','Chào mừng bạn vào phòng');
        }

        // Nếu mật khẩu sai, quay lại modal với thông báo lỗi
        return redirect()->back()->withErrors(['error' => 'Mật khẩu không chính xác']);
    }

    public function logoutRoom()
    {
        $user = Auth::user();

        // Xóa room_id của user để đăng xuất khỏi phòng
        $user->room_id = null;
        $user->save();

        // Chuyển hướng sau khi đăng xuất
        return redirect()->route('client.rooms.show')->with('success', 'Đã đăng xuất khỏi phòng.');
    }

    public function showEmotionForm($room_id)
    {
        $user = auth()->user();
        $today = now()->startOfDay();
        $room = Room::find($room_id);
        // Lấy danh sách cảm xúc và mức độ
        $emotions = Emotion::orderBy('id', 'desc')->get();
        $levels = Level::all();
        $answer = EmotionDaily::all();
        // Kiểm tra xem user đã gửi dữ liệu trong ngày chưa
        $emotionToday = EmotionDaily::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->first();

        // Trả về view kèm theo thông tin
        return view('client.emoChoose', compact('emotions', 'levels', 'emotionToday', 'room', 'answer'));
    }

    public function saveEmotionDaily(Request $request, $room_id)
    {
        $request->validate([
            'emotion_id' => 'required',
            'level_id' => 'required',
            'answer'=>'required'
        ],[
            'emotion_id.required' => 'Bạn nên chọn cảm xúc hôm nay.',
            'level_id.required' => 'Bạn nên chọn mức độ hôm nay.',
            'answer.required' => 'Lý do bạn chọn cảm xúc là gì?',
        ]);
        // Lấy thông tin từ form gửi lên
        $emotion_id = $request->input('emotion_id');
        $level_id = $request->input('level_id');
        $user_id = auth()->id(); // Lấy id người dùng hiện tại
        $answer = $request->input('answer');
        $today = now()->startOfDay();
        $existingEmotion = EmotionDaily::where('user_id', $user_id)
            ->whereDate('created_at', $today)
            ->first();
        if ($existingEmotion) {
            return redirect()->back()->with('error', 'Bạn đã gửi cảm xúc hôm nay rồi.');
        } elseif (EmotionDaily::create([
            'user_id' => $user_id,
            'room_id' => $room_id,
            'emo_id' => $emotion_id,
            'level_id' => $level_id,
            'date'=>now(),
            'answer' => $answer
        ])) {
            return redirect()->back()->with('success', 'Cảm xúc của bạn đã được lưu!');
        }

        // Chuyển hướng về trang cũ hoặc bất kỳ trang nào khác
        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}
