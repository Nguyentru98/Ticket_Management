<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //get department
    public function getDepartment()
    {
        $data = Department::with('user')->get();
        dd($data);
    }
}
