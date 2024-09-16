<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
    public function aboutUs()
    {
        return view('guest.aboutUs');
    }

    public function contactUs()
    {
        return view('guest.contactUs');
    }

    public function chart()
    {
        return view('guest.chart');
    }

    
}
