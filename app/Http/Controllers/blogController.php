<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Controllers\categoryController;
use App\http\Controllers\reactionController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function blogs()
    {
        $user = new userControler();
        $id = request('id');
        $blogs = Blog::where('category_id', $id)->get();
        foreach ($blogs as $blog) {
            $us = User::where('id', $blog->user_id)->first();
            $blog->author = $us->name;
            $like = 0;
            $dislike = 0;
            $score = DB::table('user_likes')->where('blog_id', $blog->id)->get();
            foreach ($score as $sc) {
                if ($sc->like == 1) {
                    $like++;
                } else {
                    $dislike++;
                }
            }
            $blog->like = $like;
            $blog->dislike = $dislike;
        }
        $cats = new categoryController();
        $cat = $cats->category($id);
        $del = $user->catRight();
        return view('blogs', ['blogs' => $blogs, 'category' => $cat->name, 'del' => $del]);
    }

    public function blog()
    {
        $id = request('id');
        $blog = Blog::where('id', $id)->first();
        $us = User::where('id', $blog->user_id)->first();
        $blog->author = $us->name;
        $like = 0;
        $dislike = 0;
        $score = DB::table('user_likes')->where('blog_id', $blog->id)->get();
        foreach ($score as $sc) {
            if ($sc->like == 1) {
                $like++;
            } else {
                $dislike++;
            }
        }
        $blog->like = $like;
        $blog->dislike = $dislike;
        //var_dump($blog->content);
        $recs = new reactionController();
        $rec = $recs->blogRec($blog->id);
        foreach ($rec as $r) {
            $us = User::where('id', $r->user_id)->first();
            $r->author = $us->name;
            $like = 0;
            $dislike = 0;
            $score = DB::table('user_likes')->where('reaction_id', $r->id)->get();
            foreach ($score as $sc) {
                if ($sc->like == 1) {
                    $like++;
                } else {
                    $dislike++;
                }
            }
            $r->like = $like;
            $r->dislike = $dislike;
        }
        $blog->reactions = $rec;
        return view('blog', ['blog' => $blog]);
    }

    public function form()
    {
        $user = new userControler();
        $check = $user->blogRight();
        $cat = new categoryController();
        $categoeies = $cat->all();
        if ($check == true) {
            return view('blogForm', ['action' => 'create', 'categories' => $categoeies]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function create(Request $request)
    {
        $user = new userControler();
        $id = Auth::id();
        $check = $user->blogRight();
        if ($check == false) {
            return redirect('/dashboard');
        }

        $request->validate([
            'title' => 'required',
            'tumbnail' => 'required|file|mimes:png, jpg, jpeg|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
            'content' => 'required',
        ]);

        // Sla het bestand op
        $file = $request->file('tumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->tumbnail = "/uploads/" . $fileName;
        $blog->content = $request->content;
        $blog->user_id = $id;
        $blog->category_id = $request->category;
        $blog->save();
        return redirect('/categories/category?id='.$request->category)->banner('Blogpost created');
    }

    public function edit()
    {
        $id = request('id');
        $user = new userControler();
        $check = $user->catRight();
        if ($check == false) {
            return redirect('/categories');
        }
        return view('catCreate', ['action' => 'edit?id='.$id]);
    }

    public function update(Request $request)
    {
        $user = new userControler();
        $check = $user->catRight();
        if ($check == false) {
            return redirect('/categories')->banner('insufficient rights');
        }
        $id = request('id');
        $cat = Category::where('id', $id)->first();
        $status = 'No new data was given';

        if ($request->hasFile('thumbnail')) {
            // Sla het bestand op
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            $cat->thumbnail = "/uploads/" . $fileName;
            $status = 'Category updated';
        }

        if (!empty($request->name)) {
            $cat->name = $request->name;
            $status = 'Category updated';
        }
        if ($status == 'Category updated'){
            $cat->save();
            return redirect('/categories')->banner($status);
        }
        
        return redirect('/categories')->dangerBanner($status);
    }
}
