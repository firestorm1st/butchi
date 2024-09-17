<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Contact;
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

    public function showContactUs()
    {
        return view('guest.contactUs');
    }

    public function contactUs(Request $request)
    {
       
            $contact = new Contact();
            $contact->fullname = $request->fullname;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();

            return redirect()->route('guest.showContactUs')->with('success', 'Liên hệ của bạn đã được gửi, cảm ơn bạn đã đóng góp cho chúng mình.');
    }

    
}
