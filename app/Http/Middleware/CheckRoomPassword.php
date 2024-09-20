<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use Hash;

class CheckRoomPassword
{
    public function handle($request, Closure $next)
    {
        $room = Room::find($request->route('id'));  // Lấy thông tin phòng từ route

        // Kiểm tra user có quyền truy cập phòng này không
        if (auth()->check() && auth()->user()->room_id == $room->id) {
            return $next($request);
        }else{
            return redirect()->route('client.rooms.show')
        ->with(['error' => 'Bạn chưa nhập mật khẩu phòng này']);
        }
    }
}
