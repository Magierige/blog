<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class reactionController extends Controller
{
    public function blogRec($id){
        return $rec = Reaction::where('blog_id', $id)->get();
    }
}
