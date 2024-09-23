<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\StoreRequest;
use App\Http\Requests\Admin\Contact\UpdateRequest;
use App\Models\Contact;
use App\Models\Room;
use App\Models\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.contact.index', ['contacts' => $contacts]);
    }

    public function indexRoom()
    {
        $rooms = Room::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.room.index', ['rooms' => $rooms]);
    }
    
}
