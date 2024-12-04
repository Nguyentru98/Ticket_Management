<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentServices
{
    // get list derpartment
    public function getListDepartment() {
        return Department::all();
    }
    // get derpartment by id
    public function getDepartMentById($id) {
        return Department::find($id);
    }
}
