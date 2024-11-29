<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Services\DepartmentServices;

class DepartmentController extends Controller
{
    protected DepartmentServices $departmentServices;
    public function __construct(DepartmentServices $departmentServices) {
        $this->departmentServices = $departmentServices;
    }
    //get list department
    public function getListDepartment() {
        $data = $this->departmentServices->getListDepartment();
        return response()->json($data);
    }
    
}
