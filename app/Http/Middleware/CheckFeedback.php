<?php 
namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EmotionRating;

class CheckFeedback
{
    public function handle($request, Closure $next)
    {
        // Lấy user hiện tại
        $user = Auth::user();

        if ($user) {
            // Kiểm tra xem người dùng đã gửi feedback trong 7 ngày qua chưa
            $lastFeedback = EmotionRating::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastFeedback && Carbon::parse($lastFeedback->created_at)->addDays(7)->isFuture()) {
                // Nếu feedback được tạo cách đây dưới 7 ngày, không cho phép vào trang feedback
                return redirect()->route('client.index',['id' => Auth::User()->room_id])->with('error', 'Bạn đã đánh giá trong 7 ngày qua.');
            }
        }

        return $next($request);
    }
}