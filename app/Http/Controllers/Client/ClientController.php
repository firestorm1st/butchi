<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use Hash;
use Illuminate\Http\Request;
use App\Models\Emotion;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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



    
}
