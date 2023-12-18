<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistrantionController extends Controller
{
    //ここからタグ作成
    public function tag_create_form(){
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('tag_create_form',[
            'tags'=>$tags,
        ]);
    }

    public function tag_create(Request $request){
        $tag=new Tag;
        $columns=['name'];
        foreach($columns as $column){
            $tag->$column=e($request->$column);
        }
        $tag->save();
        return back();
    }

    //ここからコメント作成
    public function comment_create_form(Recipe $recipe){
        return view('comment_create_form',[
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function comment_create(Recipe $recipe,Request $request){
        $comment=new Comment;
        $columns=['comment','user_id','recipe_id'];
        foreach($columns as $column){
            $comment->$column=e($request->$column);
        }
        $comment->save();
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }
}