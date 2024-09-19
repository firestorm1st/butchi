<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    protected $table = 'emotions';
    protected $fillable = ['name', 'image'];
}

