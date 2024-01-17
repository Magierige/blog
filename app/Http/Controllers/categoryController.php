<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function index()
    {
        $cat = Category::all();
        return view('categories', ['categories' => $cat]);
    }

    public function category($id)
    {
        return $cats = Category::where('id', $id)->first();
    }
}
