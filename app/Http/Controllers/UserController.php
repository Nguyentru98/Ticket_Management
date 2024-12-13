<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserServices;
class UserController extends Controller
{
    protected UserServices $userServices;
    public function __construct(UserServices $userServices) {
        $this->userServices = $userServices;
    }
    //get user
    public function getUser(User $user, Request $request) {
        $data = $this->userServices->getUser($request);
        return response()->json($data);
    }
    //get user PCN
    public function getUserPCN() {
        $data = $this->userServices->getUserPCN();
        return response()->json($data );
    }
    // register
    public function register(Request $request) {
        // dd($request);
        $this->userServices->register($request);
    }
    
}
