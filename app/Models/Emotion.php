<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    protected $table = 'emotions';
    protected $fillable = ['name', 'image','color'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }
}

