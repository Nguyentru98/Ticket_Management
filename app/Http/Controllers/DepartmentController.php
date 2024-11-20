<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //get department
    public function ticket()
    {
        $data = Department::find(2)->ticket;
        dd($data);
    }
    
}
