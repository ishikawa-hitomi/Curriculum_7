<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(){
        $recipe=new Recipe;
        $recipes=$recipe->where('del_flg','=',1)->get()->toArray();
        $user=new User;
        $users=$user->where('del_flg','=',1)->get()->toArray();
        var_dump($users);
        return view('main',
        [
            'recipes'=>$recipes,
            'users'=>$users,
        ]);
    }

    public function my_post(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        return view('my_post',
        [
            'recipes'=>$recipes,
        ]);
    }

    public function others_post(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        $user=new User;
        $users=$user->where('id','=',$recipe['user_id'])->get()->toArray();
        return view('others_post',
        [
            'recipes'=>$recipes,
            'users'=>$users,
        ]);
    }

    public function my_page(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        $recipes=Auth::user()->recipe()->where('del_flg','=',1)->get()->toArray();
        return view('my_page',
        [
            'users'=>$users,
            'recipes'=>$recipes,
        ]);
    }

    public function others_page(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        $recipe=new Recipe;
        $recipes=$recipe->where('del_flg','=',1)->where('user_id','=',$user['id'])->get()->toArray();
        return view('others_page',
        [
            'users'=>$users,
            'recipes'=>$recipes,
        ]);
    }
}
