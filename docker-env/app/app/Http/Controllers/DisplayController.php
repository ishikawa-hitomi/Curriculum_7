<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Like;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(){
        $recipe=new Recipe;
        $recipes=$recipe->select('recipes.id as recipe_id','recipes.main_image','recipes.display_title','recipes.user_id','users.name','users.icon')->where('recipes.del_flg','=','1')->where('users.del_flg','=','1')->join('users','recipes.user_id','=','users.id')->get()->toArray();
        var_dump($recipes);
        return view('main',
        [
            'recipes'=>$recipes,
        ]);
    }

    public function my_post(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        $ingredient=new Ingredient;
        $ingredients=$ingredient->where('recipe_id','=',$recipe['id'])->get()->toArray();
        $step=new Step;
        $steps=$step->where('recipe_id','=',$recipe['id'])->get()->toArray();
        var_dump($steps);
        return view('my_post',
        [
            'recipes'=>$recipes,
            'ingredients'=>$ingredients,
            'steps'=>$steps,
        ]);
    }

    public function others_post(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        $user=new User;
        $users=$user->where('id','=',$recipe['user_id'])->get()->toArray();
        $ingredient=new Ingredient;
        $ingredients=$ingredient->where('recipe_id','=',$recipe['id'])->get()->toArray();
        $step=new Step;
        $steps=$step->where('recipe_id','=',$recipe['id'])->get()->toArray();
        $like=Like::where('recipe_id', $recipe->id)->where('user_id',Auth::user()->id)->first();
        return view('others_post',
        [
            'recipes'=>$recipes,
            'users'=>$users,
            'ingredients'=>$ingredients,
            'steps'=>$steps,
            'like'=>$like,
        ]);
    }

    public function my_page(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        $recipes=Auth::user()->recipe()->where('del_flg','=',1)->get()->toArray();
        $likes=Like::where('likes.user_id',Auth::user()->id)->join('recipes','likes.recipe_id','=','recipes.id')->join('users','recipes.user_id','=','users.id')->get()->toArray();
        $follower=Follow::where('follow_user_id', $user['id'])->count();
        $follow=Follow::where('user_id', $user['id'])->count();
        return view('my_page',
        [
            'users'=>$users,
            'recipes'=>$recipes,
            'likes'=>$likes,
            'follower'=>$follower,
            'follow'=>$follow,
        ]);
    }

    public function others_page(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        $recipe=new Recipe;
        $recipes=$recipe->where('del_flg','=',1)->where('user_id','=',$user['id'])->get()->toArray();
        $likes=Like::where('likes.user_id',$user['id'])->join('recipes','likes.recipe_id','=','recipes.id')->join('users','recipes.user_id','=','users.id')->get()->toArray();
        $myfollow=Follow::where('follow_user_id', $user['id'])->where('user_id',Auth::user()->id)->get()->toArray();
        $follower=Follow::where('follow_user_id', $user['id'])->count();
        $follow=Follow::where('user_id', $user['id'])->count();
        var_dump($myfollow);
        return view('others_page',
        [
            'users'=>$users,
            'recipes'=>$recipes,
            'likes'=>$likes,
            'myfollow'=>$myfollow,
            'follower'=>$follower,
            'follow'=>$follow,
        ]);
    }

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

    public function add_follow(User $user){
        $follow=new Follow;
        $follow->follow_user_id=$user->id;
        $follow->user_id=Auth::user()->id;
        $follow->save();
        return back();
    }

    public function remove_follow(User $user){
        $users=Auth::user()->id;
        $follow=Follow::where('follow_user_id',$user->id)->where('user_id',$users)->first();
        $follow->delete();
        return back();
    }

    public function follow_view(User $user){
        $follows=Follow::where('user_id', $user['id'])->join('users','follow_user_id','=','users.id')->get()->toArray();
        $myfollow=Follow::where('user_id', Auth::user()->id)->get()->toArray();

        var_dump($myfollow);
        return view('follow_view',
        [
            'follows'=>$follows,
            'myfollow'=>$myfollow,
        ]);
    }

    public function follower_view(User $user){
        $followers=Follow::where('follow_user_id', $user['id'])->join('users','user_id','=','users.id')->get()->toArray();
        $myfollow=Follow::where('user_id', Auth::user()->id)->get()->toArray();
        var_dump($myfollow);
        return view('follower_view',
        [
            'followers'=>$followers,
            'myfollow'=>$myfollow,
        ]);
    }
}
