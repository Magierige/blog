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
        $bRight = $user->blogRight();
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
        return view('blogs', ['blogs' => $blogs, 'category' => $cat->name, 'del' => $del, 'blog' => $bRight]);
    }

    public function blogOnId($id)
    {
        $blog = Blog::where('id', $id)->first();
        return $blog;
    }

    public function blog()
    {
        $id = request('id');
        $uid = Auth::id();
        $check = Blog::where('id', $id)->where('user_id', $uid)->first();
        $edit = false;
        if ($check != null) {
            $edit = true;
        }
        $blog = $this->blogOnId($id);
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
        return view('blog', ['blog' => $blog, 'edit' => $edit]);
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
            'category' => 'required',
        ]);

        // Sla het bestand op
        $file = $request->file('tumbnail');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->tumbnail = "/uploads/" . $fileName;
        $blog->content = str_replace('src="https://source.unsplash.com/random/800x600"', 'src="/uploads/' . $fileName . '"', $request->content);
        $blog->user_id = $id;
        $blog->category_id = $request->category;
        $blog->save();
        return redirect('/categories/category?id='.$request->category)->banner('Blogpost created');
    }

    public function edit()
    {
        $id = request('id');
        $uid = Auth::id();
        $user = new userControler();
        $check = $user->blogRight();
        $check2 = Blog::where('id', $id)->where('user_id', $uid)->first();
        $blog = $this->blogOnId($id);
        if ($check == false || $check2 == null) {
            return redirect('/dashboard');
        }
        $cat = new categoryController();
        $categoeies = $cat->all();
        return view('blogForm', ['action' => 'edit?id='.$id, 'categories' => $categoeies, 'blog' => $blog]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $uid = Auth::id();
        $user = new userControler();
        $check = $user->blogRight();
        $check2 = Blog::where('id', $id)->where('user_id', $uid)->first();
        
        if ($check == false || $check2 == null) {
            return redirect('/dashboard');
        }
        
        $blog = $this->blogOnId($id);
        $status = 'No new data was given';

        if ($request->hasFile('tumbnail')) {
            // Sla het bestand op
            $file = $request->file('tumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            $blog->tumbnail = "/uploads/" . $fileName;
            $status = 'Blog updated';
        }else {
            $fileName = substr($blog->tumbnail, 9);
        }

        if (!empty($request->title)) {
            $blog->title = $request->title;
            $status = 'Blog updated';
        }

        if (!empty($request->content)) {
            $blog->content = str_replace('src="https://source.unsplash.com/random/800x600"', 'src="/uploads/' . $fileName . '"', $request->content);
            $status = 'Blog updated';
        }

        if (!empty($request->category)) {
            $blog->category_id = $request->category;
            $category = $request->category;
            $status = 'Blog updated';
        }else {
            $category = $blog->category_id;
        }

        if ($status == 'Blog updated'){
            $blog->save();
            return redirect('/categories/category?id='.$category)->banner($status);
        }
        
        return redirect('/categories/category?id='.$category)->dangerBanner($status);
    }
}
