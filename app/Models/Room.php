<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    // Nếu mật khẩu được mã hóa
    protected $guarded = [];
    
    public function User(){
        return $this->hasMany(User::class);
    }
    protected $casts = [
        'password' => 'hashed',
    ];
}
