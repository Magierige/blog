<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserLikes;
use Illuminate\Support\Facades\Auth;

class userLikeController extends Controller
{
    public function likeCheck($id, $type)
    {
        $user = Auth::id();
        $like = UserLikes::where('user_id', $user)->where($type.'_id', $id)->first();
        if ($like == null) {
            return false;
        } else {
            return true;
        }
    }

    public function like(Request $request)
    {
        $bId = $request->input('bId');
        $rId = $request->input('rId');
        if($request->input('like') == '0'){
            $like = false;
        }else{
            $like = true;
        }
        //$like = $request->input('like');
        $user = Auth::id();
        $type = 'blog';
        if($rId == null){
            $id = $bId;
        }else{
            $id = $rId;
            $type = 'reaction';
        }
        //dd($id, $rId, $bId, $like, $user, $type);
        if ($this->likeCheck($id, $type)) {
            $uLike = UserLikes::where('user_id', $user)->where($type.'_id', $id)->first();
            if ($uLike->like == $like) {
                $uLike->delete();
            }else{
                $uLike->like = $like;
                $uLike->save();
            }
        } else {
            $uLike = UserLikes::create([
                'user_id' => $user,
                $type.'_id' => $id,
                'like' => $like
            ]);
        }
        return redirect('/blog?id='.$bId);
    }
}
