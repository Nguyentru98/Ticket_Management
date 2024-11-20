<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //get ticket
    public function getUser() {
        $data = User::with('ticket')->get();
        dd($data);
    }
}
