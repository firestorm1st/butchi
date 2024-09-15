<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}