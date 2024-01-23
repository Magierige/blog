<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userControler;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    
    public function catPage()
    {
        $cat = Category::paginate(3);
        $user = new userControler();
        $check = $user->catRight();
        return view('catPage', ['catPages' => $cat, 'check' => $check]);
    }

    public function test()
    {
        $cat = Category::paginate(3);
        $user = new userControler();
        $check = $user->catRight();
        return view('catPage', ['catPages' => $cat, 'check' => $check]);	
    }

    public function form()
    {
        $user = new userControler();
        $check = $user->catRight();
        if($check == true){
            return view('catCreate');
        }
        else{
            return redirect('/categories');
        }
    }

    public function create(Request $request)
    {
        $user = new userControler();
        $id = Auth::id();
        $check = $user->catRight();
        if($check == false){
            return redirect('/categories');
        }

        $request->validate([
            'name' => 'required',
            'thumbnail' => 'required|file|mimes:png, jpg, jpeg|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
        ]);

        // Sla het bestand op
    $file = $request->file('thumbnail');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('uploads', $fileName, 'public');

        $cat = new Category();
            $cat->name = $request->name;
            $cat->thumbnail ="/uploads/" . $fileName;
            $cat->user_id = $id;
            $cat->save();
            return redirect('/categories')->banner('Category created');
    }

    public function help()
    {
        echo 'tes 1';
        $url = Storage::get('public/uploads/text.txt');
        echo $url;
        echo 'test 2';
    } 
}
