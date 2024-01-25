<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Controllers\categoryController;
use App\http\Controllers\reactionController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
}
