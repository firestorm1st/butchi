<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmotionRating extends Model
{
    use HasFactory;

    protected $table = 'emotion_rating'; // Tên bảng đánh giá

    protected $fillable = [
        'user_id',
        'rating',
        'answer1',
        'answer2',
        'created_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}