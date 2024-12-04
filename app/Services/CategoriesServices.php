<?php

namespace App\Services;

use App\Models\Categori;
use Illuminate\Http\Request;

class CategoriesServices
{
    // get list categories
    public function categoriesList() {
        return Categori::all();
    }
}
