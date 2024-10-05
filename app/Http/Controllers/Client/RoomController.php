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
use App\Models\Mission;
use App\Models\User;
use App\Models\MissionDaily;
use App\Models\RatingDaily;
use App\Models\EmotionRating;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function showFullEmo($roomId)
    {
        $room = Room::findOrFail($roomId);
        // Lấy danh sách cảm xúc hàng ngày từ bảng EmotionDaily theo room_id
        $emotions = EmotionDaily::with(['user', 'emotion', 'level'])
            ->whereHas('user', function ($query) use ($roomId) {
                $query->where('room_id', $roomId);
            })
            ->get();

        return view('client.emoIndex', ['rooms' => $room, 'emotions' => $emotions]);
    }

    public function index(string $id)
    {
        $room = Room::findOrFail($id);  // Tìm phòng theo ID

        // Kiểm tra xem user có thuộc phòng này không
        if (auth()->user()->room_id !== $room->id) {
            return redirect()->route('client.rooms.enter', ['id' => $room->id])->with(['error' => 'Bạn chưa nhập mật khẩu phòng này']);
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
        } else {
            $request->validate([
                'name' => 'required|string|max:8',
                'password' => 'required|string|confirmed', // Confirm password validation
            ], [
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

    public function enterRoom(Request $request)
{
    // Lấy room_id và password từ request
    $roomId = $request->input('room_id');
    $password = $request->input('password');

    // Tìm phòng theo room_id
    $room = Room::find($roomId);

    if ($room && Hash::check($password, $room->password)) {
        // Gán room_id cho user hiện tại
        $user = auth()->user();
        $user->room_id = $room->id;

        $user->save();

        // Chuyển hướng đến trang client/index/{id}
        return redirect()->route('client.index', ['id' => $room->id])->with('success', 'Chào mừng bạn vào phòng');
    }

    // Nếu mật khẩu sai hoặc phòng không tồn tại, quay lại với thông báo lỗi
    return redirect()->back()->with(['error' => 'Mật khẩu không chính xác']);
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
            'answer' => 'required'
        ], [
            'emotion_id.required' => 'Bạn nên chọn cảm xúc hôm nay.',
            'level_id.required' => 'Bạn nên chọn mức độ hôm nay.',
            'answer.required' => 'Lý do bạn chọn cảm xúc là gì?',
        ]);
        $user_id=Auth::User()->id;
        $recentFeedback = EmotionRating::where('user_id', $user_id)
            ->where('created_at', '>=', now()->subDays(7))
            ->first();
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
            'date' => now(),
            'answer' => $answer
        ])) 
        {
            if($recentFeedback){
                return redirect()->back()->with('success','Bạn đã "Vẽ" tâm tư thành công');
            }else{
                return redirect(route('client.Feedback'));
            }
        }
    }

    public function showFeedbackForm(Request $request)
    {
        return view('client.feedback');
    }

    public function saveFeedback(Request $request)
    {
        // Xác thực dữ liệu từ form
        $request->validate([
            'rating' => 'required',
            'answer1' => 'required|string|max:255',
            'answer2' => 'required|string|max:255',
        ], [
            'rating.required' => 'Bạn cần chọn mức đánh giá.',
            'answer1.required' => 'Bạn cần chia sẻ cảm nhận.',
            'answer2.required' => 'Bạn cần chia sẻ về sự thay đổi.',
        ]);

        // Lấy dữ liệu từ form
        $user_id = auth()->id();
        $rating = $request->input('rating');
        $answer1 = $request->input('answer1');
        $answer2 = $request->input('answer2');

        // Lưu feedback
        $feedback = EmotionRating::create([
            'user_id' => $user_id,
            'rating' => $rating,
            'answer1' => $answer1,
            'answer2' => $answer2,
            'created_at' => now(),
        ]);

        // Trả về phản hồi
        if ($feedback) {
            return redirect()->route('client.index',['id' => Auth::User()->room_id])->with('success','Cảm ơn bạn đã đánh giá!');
        }

        return redirect()->back()->with('error','Có lỗi xảy ra');
    }

    public function showCheckin(string $id)
    {
        $currentMonth = Carbon::now()->format('Y-m');

        // Get the check-in dates for the current month
        $checkin = MissionDaily::where('user_id', $id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->pluck('created_at')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            });

        // Debugging output to check what checkin contains
        // dd($checkin);

        // Check if the user has already checked in today
        $existingMission = MissionDaily::where('user_id', $id)
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->first();

        if ($existingMission) {
            $mission = Mission::where('id', $existingMission->mission_id)->first();
            // Pass the check-in dates to the view as 'checkin'
            return view('client.checkinPage', compact('existingMission', 'mission', 'checkin'))
                ->with('error', 'Bạn đã hoàn thành màu yêu thương hôm nay rồi.');
        } else {
            $user = User::find($id);
            $offline = $user->is_offline;

            $mission = DB::table('missions')
                ->where('day', '=', Carbon::now()->format('Y-m-d'))
                ->where('is_offline', $offline)
                ->first();

            // Pass the check-in dates to the view as 'checkin'
            return view('client.checkinPage', compact('existingMission', 'mission', 'checkin'));
        }
    }

    public function checkin(Request $request, string $id)
    {
        $mission_daily = new MissionDaily();
        $mission_daily->user_id = Auth::user()->id;
        $mission_daily->mission_id = $id;
        $mission_daily->save();
        return redirect()->route('client.showCheckin')->with('success', 'Check-in thành công!');
    }

    public function submitFeedback(Request $request) 
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'mission_id' => 'required',
            'rating' => 'required|integer|min:0|max:10',
            'answer' => 'required|string',
        ]);

        // Lưu feedback
        RatingDaily::create([
            'user_id' => auth()->id(),
            'mission_id' => $request->input('mission_id'),
            'rating' => $request->input('rating'),
            'answer' => $request->input('answer'),
        ]);

        // Lưu mission_daily
        $missionId = $request->input('mission_id'); // Lấy mission_id từ request
        $mission_daily = new MissionDaily();
        $mission_daily->user_id = Auth::user()->id;
        $mission_daily->mission_id = $missionId; // Sử dụng missionId vừa lấy
        $mission_daily->save();

        // Trả về phản hồi JSON
        return redirect()->back()->with('success','Bạn đã điểm danh thành công');
    }

    public function filterByUser(Request $request,$room_id)
    {
        $user_id = $request->input('user_id');
        $roomid=$room_id;
        // Lấy tất cả người dùng trong phòng
        $users = User::where('room_id',$roomid)->get(); // Hoặc giới hạn theo phòng nếu cần
        
        $emotions = EmotionDaily::whereHas('user', function($query) use ($room_id) {
            $query->where('room_id', $room_id);
        })
        ->when($user_id, function($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        })
        ->get();
        return view('client.emoView', compact('emotions', 'users','roomid'));
    }
}
