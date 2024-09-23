<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\StoreRequest;
use App\Http\Requests\Admin\Contact\UpdateRequest;
use App\Models\Contact;
use App\Models\Room;
use App\Models\User;

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
}
