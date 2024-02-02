<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Controllers\categoryController;
use App\http\Controllers\reactionController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userLikeController;

class blogController extends Controller
{
    public function blogs()
    {
        $user = new userControler();
        $ulike = new userLikeController();
        $id = request('id');
        $bRight = $user->blogRight();
        $blogs = Blog::where('category_id', $id)->get();
        foreach ($blogs as $blog) {
            $like = $ulike->getLikes($blog->id, 'blog');
            $dislike = $ulike->getDislikes($blog->id, 'blog');
            $blog->author = $user->findName($blog->user_id)->name;
            $blog->like = $like[1];
            $blog->dislike = $dislike[1];
            if ($like[0] == true) {
                $blog->ulike = true;
            } else if ($dislike[0] == true) {
                $blog->ulike = false;
            } else {
                $blog->ulike = null;
            }
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
        $user = new userControler();
        $ulike = new userLikeController();
        $uid = Auth::id();
        $check = Blog::where('id', $id)->where('user_id', $uid)->first();
        $edit = false;
        if ($check != null || $user->isAdmin()) {
            $edit = true;
        }
        $blog = $this->blogOnId($id);
        $blog->author = $user->findName($blog->user_id)->name;
        $blog->ulike = null;
        $like = $ulike->getLikes($blog->id, 'blog');
        $dislike = $ulike->getDislikes($blog->id, 'blog');
        $blog->like = $like[1];
        $blog->dislike = $dislike[1];
        if ($like[0] == true) {
            $blog->ulike = true;
        } else if ($dislike[0] == true) {
            $blog->ulike = false;
        } else {
            $blog->ulike = null;
        }
        //var_dump($blog->content);
        $recs = new reactionController();
        $rec = $recs->blogRec($blog->id);
        foreach ($rec as $r) {
            $r->author = $user->findName($blog->user_id)->name;
            $like = $ulike->getLikes($r->id, 'reaction');
            $dislike = $ulike->getDislikes($r->id, 'reaction');
            $r->author = $user->findName($r->user_id)->name;
            $r->like = $like[1];
            $r->dislike = $dislike[1];
            if ($like[0] == true) {
                $r->ulike = true;
            } else if ($dislike[0] == true) {
                $r->ulike = false;
            } else {
                $r->ulike = null;
            }
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
            return redirect('/dashboard')->dangerBanner('You do not have the right to create a blog');
        }
    }

    public function create(Request $request)
    {
        $user = new userControler();
        $id = Auth::id();
        $check = $user->blogRight();
        if ($check == false) {
            return redirect('/dashboard')->dangerBanner('You do not have the right to create a blog');
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
        return redirect('/categories/category?id=' . $request->category)->banner('Blogpost created');
    }

    public function edit()
    {
        $id = request('id');
        $uid = Auth::id();
        $user = new userControler();
        $check = $user->blogRight();
        $check2 = Blog::where('id', $id)->where('user_id', $uid)->first();
        $blog = $this->blogOnId($id);
        if (!$user->isAdmin()) {
            if ($check == false || $check2 == null) {
                return redirect('/dashboard')->dangerBanner('You do not have the right to edit this blog');
            }
        }
        $cat = new categoryController();
        $categoeies = $cat->all();
        return view('blogForm', ['action' => 'edit?id=' . $id, 'categories' => $categoeies, 'blog' => $blog]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $uid = Auth::id();
        $user = new userControler();
        $check = $user->blogRight();
        $check2 = Blog::where('id', $id)->where('user_id', $uid)->first();
        if (!$user->isAdmin()) {
            if ($check == false || $check2 == null) {
                return redirect('/dashboard')->dangerBanner('You do not have the right to edit this blog');
            }
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
        } else {
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
        } else {
            $category = $blog->category_id;
        }

        if ($status == 'Blog updated') {
            $blog->save();
            return redirect('/categories/category?id=' . $category)->banner($status);
        }

        return redirect('/categories/category?id=' . $category)->dangerBanner($status);
    }
}
