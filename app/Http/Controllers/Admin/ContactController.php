<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\UpdateRequest;
use App\Models\Contact;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmotionDaily;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.contact.index', ['contacts' => $contacts]);
    }

    public function indexRoom()
    {
        $rooms = Room::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.room.index', ['rooms' => $rooms]);
    }
    
    public function editRoom(string $id)
    {
        $room = Room::find($id);
        if ($room == null) {
            abort(404);
        }
        $user = User::where('id', $room->user_id)->first();
        $email = $user->email;
        return view('admin.modules.room.edit', ['room' => $room, 'email' => $email]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRoom(UpdateRequest $request, string $id)
    {
        
        $room = Room::find($id);
        if ($room == null) {
            abort(404);
        }

            $room->name = $request->name;
            $room->password = bcrypt($request->password);
            $room->save();

            return redirect()->route('admin.room.index')->with('success', 'Cập nhật thông tin phòng thành công.');  
    }
    
    public function filterByUserAdmin(Request $request)
    {
        $user_id = $request->input('user_id');
        // Lấy tất cả người dùng trong phòng
        $users = User::all(); // Hoặc giới hạn theo phòng nếu cần
        
        $emotions = EmotionDaily::when($user_id, function($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        })->get();
        return view('admin.modules.room.emoIndex', compact('emotions', 'users'));
    }
}
