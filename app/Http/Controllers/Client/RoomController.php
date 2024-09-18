<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
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
            return redirect()->route('client.index', ['id' => $room->id]);
        }

        // Nếu mật khẩu sai, quay lại modal với thông báo lỗi
        return redirect()->back()->withErrors(['password' => 'Mật khẩu không chính xác']);
    }
}
