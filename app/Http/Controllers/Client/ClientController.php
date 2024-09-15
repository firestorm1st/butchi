<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showPencil()
    {
        //return view('client.modules.pencil');
    }

    public function pencil(Request $request)
    {
        // return view('client.modules.pencil');
    }

    public function showCheckin()
    {
        //return view('client.modules.checkin');
    }

    public function checkin(Request $request)
    {
        // return view('client.modules.checkin');
    }

    public function room()
    {
        return view('client.room');
    }

    public function accountPage(){
        return view('client.accountPage');
    }
}
