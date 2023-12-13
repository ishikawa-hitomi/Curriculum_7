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

    //ここから新規投稿、材料、分量
    public function ingredient_create_form(Recipe $recipe){
        return view('ingredient_create_form',[
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function ingredient_create(Recipe $recipe,Request $request){
        $name=$request['name'];
        $quantity=$request['quantity'];
        $count=count($name);
        for($a=0; $a<$count; $a++){
            $ingredient=new Ingredient;
            $ingredient->name=$name[$a];
            $ingredient->quantity=$quantity[$a];
            $ingredient->recipe_id=$recipe['id'];
            $ingredient->save();
        }
        return redirect('/step_create/'.$recipe['id']);
    }

    //ここから新規投稿、手順
    public function step_create_form(Recipe $recipe){
        return view('step_create_form',[
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function step_create(Recipe $recipe,Request $request){
        $procedure=$request['procedure'];
        $sub_image=$request['sub_image'];
        $count=count($procedure);
        for($a=0; $a<$count; $a++){
            $step=new Step;
            $step->procedure=$procedure[$a];
            $step->recipe_id=$recipe['id'];
            $image_path=$sub_image[$a]->store('public');
            $step->sub_image=basename($image_path);
            $step->save();
        }
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }

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
            $tag->$column=$request->$column;
        }
        $tag->save();
        return redirect(route('recipe.create'));
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
            $comment->$column=$request->$column;
        }
        $comment->save();
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }

    //ここから投稿編集、材料、分量
    public function ingredient_edit_form(Recipe $recipe){
        $ingredients=$recipe->ingredients->toArray();
        return view('ingredient_edit_form',[
            'ingredients'=>$ingredients,
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function ingredient_edit(Recipe $recipe,Request $request){
        Ingredient::where('recipe_id','=',$recipe['id'])->delete();
        $name=$request['name'];
        $quantity=$request['quantity'];
        $count=count($name);
        for($a=0; $a<$count; $a++){
            $ingredient=new Ingredient;
            $ingredient->name=$name[$a];
            $ingredient->quantity=$quantity[$a];
            $ingredient->recipe_id=$recipe['id'];
            $ingredient->save();
        }
        return redirect('/step_edit/'.$ingredient['recipe_id']);
    }

    //ここから投稿編集、手順
    public function step_edit_form(Recipe $recipe){
        $steps=$recipe->steps->toArray();
        return view('step_edit_form',[
            'steps'=>$steps,
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function step_edit(Recipe $recipe,Request $request){
        Step::where('recipe_id','=',$recipe['id'])->delete();
        $procedure=$request['procedure'];
        $sub_image=$request['sub_image'];
        $count=count($procedure);
        for($a=0; $a<$count; $a++){
            $step=new Step;
            $step->procedure=$procedure[$a];
            $step->recipe_id=$recipe['id'];
            $image_path=$sub_image[$a]->store('public');
            $step->sub_image=basename($image_path);
            $step->save();
        }
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }
}