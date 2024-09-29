<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modules.index');
    }

    public function vetamtu()
    {
        $feedbacks = DB::table('emotion_rating')->orderBy('created_at', 'DESC')-> get();
        return view('admin.modules.feedback.indexVeTamTu', ['feedbacks' => $feedbacks]);
      
    }

    public function mauyeuthuong()
    {
        $feedbacks = DB::table('rating_daily_attendance')->orderBy('created_at', 'DESC')-> get();
        return view('admin.modules.feedback.indexMauYeuThuong', ['feedbacks' => $feedbacks]);
      
    }
}
