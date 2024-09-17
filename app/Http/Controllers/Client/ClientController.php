<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
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

        return redirect()->route('client.index')->with('success', 'Phòng đã được tạo thành công');
    }

    // Redirect to the client index page with an error message if saving fails
    return redirect()->route('client.index')->with('error', 'Có lỗi xảy ra');
}


    public function showRooms()
    {
        $rooms = Room::where('status', 1)->get();
        return view('client.room', compact('rooms'));
    }

    public function enterRoom(Request $request)
    {
        $room = Room::find($request->room_id);

        if ($room && Hash::check($request->password, $room->password)) {
            Auth::user()->update(['room_id' => $room->id]);
            session(['authenticated_room' => $room->id]);
            return redirect()->route('client.index');
        } else {
            return back()->withErrors(['password' => 'Mật khẩu không đúng!']);
        }
    }

    public function showAccount($id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('client.accountPage', ['user' => $user, 'id' => $id]);
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

        $user->role = $request->role;

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
}
