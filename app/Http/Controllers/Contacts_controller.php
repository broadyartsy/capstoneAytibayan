<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contacts_controller extends Controller
{
    public function contact_view(){
        return view('contacts');
    }
}
