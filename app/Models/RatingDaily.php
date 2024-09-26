<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingDaily extends Model
{
    protected $table = 'rating_daily_attendance';

    protected $fillable = ['user_id', 'rating', 'answer','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

