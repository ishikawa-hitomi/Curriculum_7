<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use App\Models\Step;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(){
        $recipe=new Recipe;
        $recipes=$recipe->select('recipes.id as recipe_id','recipes.main_image','recipes.display_title','recipes.user_id','users.name')->where('recipes.del_flg','=','1')->where('users.del_flg','=','1')->join('users','recipes.user_id','=','users.id')->get()->toArray();
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
        return view('others_post',
        [
            'recipes'=>$recipes,
            'users'=>$users,
            'ingredients'=>$ingredients,
            'steps'=>$steps,
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
