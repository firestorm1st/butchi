<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('admin.modules.user.index');
    // }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.user.index', ['users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = new User();
        $request->validate([
            'avatar' => 'required|mimes:jpg,png,bmp,jpeg',
        ]);


        $avatar = $request->avatar;
        $avatarName = time() . '-' . $avatar->getClientOriginalName();
        $avatar->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/', $avatarName);
        $user->avatar = $avatarName;


        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->is_offline = $request->is_offline;
        $user->role = $request->role;


        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Tạo mới người dùng thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }
        return view('admin.modules.user.edit', ['user' => $user, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'image' => 'mimes:jpg,png,bmp,jpeg',
        ]);

        if ($user->email == null) {
            return redirect()->route('admin.user.index')->with('error', 'Email chưa đăng ký tài khoản.');
        }

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

        $user->is_offline = $request->is_offline;
        $user->role = $request->role;
        // dd($user);
        $user->update();

        return redirect()->route('admin.user.index')->with('success', 'Cập nhật thông tin người dùng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        if ($user == null) {
            abort(404);
        }

        $old_image_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $user->avatar;
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Xóa người dùng thành công.');
    }
}
