<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function showAccount($id){
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('client.accountPage', ['user' => $user, 'id' => $id]);
    }

    public function account(Request $request, string $id){
        
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

    public function changeAccount(string $id){
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('client.changeAccount', ['user' => $user, 'id' => $id]);
    }
}
