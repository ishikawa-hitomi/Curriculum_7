<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Like;
use App\Models\Follow;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    //投稿のいいね、いいね取り消し
    public function add_like(Recipe $recipe){
        $like=new Like;
        $like->recipe_id=$recipe->id;
        $like->user_id=Auth::user()->id;
        $like->save();
        return back();
    }
    public function remove_like(Recipe $recipe){
        $user=Auth::user()->id;
        $like=Like::where('recipe_id',$recipe->id)->where('user_id',$user)->first();
        $like->delete();
        return back();
    }

    //ユーザーのフォロー、フォロー取り消し
    public function add_follow(User $user){
        $follow=new Follow;
        $follow->following_id=$user->id;
        $follow->follower_id=Auth::user()->id;
        $follow->save();
        return back();
    }
    public function remove_follow(User $user){
        $users=Auth::user()->id;
        $follow=Follow::where('following_id',$user->id)->where('follower_id',$users)->first();
        $follow->delete();
        return back();
    }

    //フォロー一覧画面
    public function follow_view(User $user){
        $myfollow=Auth::user()->follower->toArray();
        $followings=$user->follower()->join('users','following_id','=','users.id')->where('deleted_at',null)->get()->toArray();
        $myfollow=array_column($myfollow,'following_id');
        return view('follow_view',
        [
            'follows'=>$followings,
            'myfollow'=>$myfollow,
        ]);
    }
    //フォロワー一覧画面
    public function follower_view(User $user){
        $myfollow=Auth::user()->follower->toArray();
        $followers=$user->following()->join('users','follower_id','=','users.id')->where('deleted_at',null)->get()->toArray();
        $myfollow=array_column($myfollow,'following_id');
        return view('follower_view',
        [
            'followers'=>$followers,
            'myfollow'=>$myfollow,
        ]);
    }
}
