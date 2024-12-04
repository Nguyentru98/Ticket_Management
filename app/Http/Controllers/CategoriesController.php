<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoriesServices;

class CategoriesController extends Controller
{
    protected CategoriesServices $categoriesServices;

    public function __construct(
        CategoriesServices $categoriesServices
    ) 
    {
        $this->categoriesServices = $categoriesServices;
    }
    public function listCategories() {
       $categories =  $this->categoriesServices->categoriesList();
       return $categories;
    }
}
