<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmotionDaily extends Model
{
    protected $table = 'emotion_daily';

    protected $fillable = ['user_id', 'emo_id', 'level_id', 'answer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emotion()
    {
        return $this->belongsTo(Emotion::class, 'emo_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}

