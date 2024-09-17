<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoomPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->room_id || !session('authenticated_room') || $user->room_id != session('authenticated_room')) {
            return redirect()->route('client.rooms.show')->withErrors(['password' => 'Bạn cần nhập mật khẩu phòng đúng để tiếp tục.']);
        }

        return $next($request);
    }
}
