<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(){
        $recipes=Auth::user()->recipe()->where('del_flg','=',1)->get()->toArray();
        return view('main',
        [
            'recipes'=>$recipes,
        ]);
    }

    public function post(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        return view('post',
        [
            'recipes'=>$recipes,
        ]);
    }
}
