<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use App\Models\Ingredient;
use App\Models\Step;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;
use App\Http\Requests\UserData;
use App\Http\Requests;

class RegistrantionController extends Controller
{
    //ここから新規投稿
    public function recipe_create_form(){
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('recipe_create_form',[
            'tags'=>$tags,
        ]);
    }

    public function recipe_create(CreateData $request){
        $recipe=new Recipe;
        $columns=['display_title','title','time','serve','tag_id','memo'];
        foreach($columns as $column){
            $recipe->$column=$request->$column;
        }
        $image_path=$request->file('main_image')->store('public');
        $recipe->main_image=basename($image_path);
        Auth::user()->recipe()->save($recipe);
        return redirect('/ingredient_create/'.$recipe['id']);
    }

    //ここから新規投稿、材料、分量
    public function ingredient_create_form(Recipe $recipe){
        $recipes=$recipe->where('id','=',$recipe['id'])->get()->toArray();
        return view('ingredient_create_form',[
            'recipes'=>$recipes,
        ]);
    }

    public function ingredient_create(Recipe $recipe,Request $request){
        $ingredient=new Ingredient;
        $input=$request->input();
        foreach($input as $val){
            $ingredient->name=$val['name'];
            $ingredient->quantity=$val['quantity'];
        }
        $ingredient->recipe_id=$request->recipe_id;
        $ingredient->save();
        var_dump($input);
        return redirect('/step_create/'.$recipe['id']);
    }

    //ここから新規投稿、手順
    public function step_create_form(Recipe $recipe){
        $recipes=$recipe->where('id','=',$recipe['id'])->get()->toArray();
        return view('step_create_form',[
            'recipes'=>$recipes,
        ]);
    }

    public function step_create(Recipe $recipe,Request $request){
        $step=new Step;
        $columns=['procedure','recipe_id'];
        foreach($columns as $column){
            $step->$column=$request->$column;
        }
        $image_path=$request->file('sub_image')->store('public');
        $step->sub_image=basename($image_path);
        $step->save();
        return redirect('/');
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
        return redirect('/recipe_create');
    }

    //ここから投稿編集
    public function recipe_edit_form(Recipe $recipe){
        $result=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('recipe_edit_form',[
            'recipes'=>$result,
            'tags'=>$tags,
        ]);
    }

    public function recipe_edit(Recipe $recipe,Request $request){
        $columns=['display_title','title','time','serve','tag_id','memo'];
        foreach($columns as $column){
            $recipe->$column=$request->$column;
        }
        $image_path=$request->file('main_image');
        if(isset($image_path)){
            \Storage::disk('public')->delete($image_path);
            $image_path=$image_path->store('public');
            $recipe->main_image=basename($image_path);
        }
        Auth::user()->recipe()->save($recipe);
        return redirect('/ingredient_edit/'.$recipe['id']);
    }

    //ここから投稿編集、材料、分量
    public function ingredient_edit_form(Recipe $recipe){
        $ingredients=$recipe->join('ingredients','recipes.id','=','ingredients.recipe_id')->where('ingredients.recipe_id','=',$recipe['id'])->get()->toArray();
        var_dump($ingredients);
        return view('ingredient_edit_form',[
            'recipes'=>$ingredients,
        ]);
    }

    public function ingredient_edit(Recipe $recipe,Request $request){
        $ingredient=new Ingredient;
        $columns=['name','quantity','recipe_id'];
        foreach($columns as $column){
            $ingredient->$column=$request->$column;
        }
        $ingredient->save();
        return redirect('/step_edit/'.$ingredient['recipe_id']);
    }

    //ここから投稿編集、手順
    public function step_edit_form(Recipe $recipe){
        $recipes=$recipe->join('steps','recipes.id','=','steps.recipe_id')->where('steps.recipe_id','=',$recipe['id'])->get()->toArray();
        var_dump($recipes);
        return view('step_edit_form',[
            'recipes'=>$recipes,
        ]);
    }

    public function step_edit(Recipe $recipe,Request $request){
        $step=new Step;
        $columns=['procedure','recipe_id'];
        foreach($columns as $column){
            $step->$column=$request->$column;
        }
        $image_path=$request->file('sub_image');
        if(isset($image_path)){
            \Storage::disk('public')->delete($image_path);
            $image_path=$image_path->store('public');
            $step->sub_image=basename($image_path);
        }
        $step->save();
        return redirect('/');
    }


    //ここから投稿削除（一般ユーザー用、倫理削除）
    public function recipe_delete_form(Recipe $recipe){
        $recipes=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        return view('recipe_delete_form',[
            'recipes'=>$recipes,
        ]);
    }

    public function recipe_delete(Recipe $recipe,Request $request){
        $columns=['del_flg'];
        foreach($columns as $column){
            $recipe->$column=$request->$column;
        }
        Auth::user()->recipe()->save($recipe);
        return redirect('/');
    }

    //ここからプロフィール情報編集
    public function profile_edit_form(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        return view('profile_edit_form',[
            'users'=>$users,
        ]);
    }

    public function profile_edit(User $user,Request $request){
        $columns=['profile'];
        foreach($columns as $column){
            $user->$column=$request->$column;
        }
        $image_path=$request->file('icon');
        if(isset($image_path)){
            \Storage::disk('public')->delete($image_path);
            $image_path=$image_path->store('public');
            $user->icon=basename($image_path);
        }
        $user->save();
        return redirect('/my_page/'.$user['id']);
    }

    //ここからユーザー情報編集
    public function user_edit_form(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        return view('user_edit_form',[
            'users'=>$users,
        ]);
    }

    public function user_edit(User $user,UserData $request){
        $columns=['name','email'];
        foreach($columns as $column){
            $user->$column=$request->$column;
        }
        $user->save();
        return redirect('/my_page/'.$user['id']);
    }

    //ここからアカウント削除
    public function user_delete_form(User $user){
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        return view('user_delete_form',[
            'users'=>$users,
        ]);
    }

    public function user_delete(User $user,Request $request){
        $columns=['name','email'];
        foreach($columns as $column){
            $user->$column=$request->$column;
        }
        $user->save();
        return redirect('/my_page/'.$user['id']);
    }
}