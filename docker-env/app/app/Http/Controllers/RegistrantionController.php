<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateData;
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
        Auth::user()->recipe()->save($recipe);
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
        Auth::user()->recipe()->save($tag);
        return redirect('/recipe_create');
    }

    //ここから投稿編集
    public function recipe_edit_form(Recipe $recipe){
        $result=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        if(is_null($result)){
            abort(404);
        }
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('recipe_edit_form',[
            'recipes'=>$result,
            'tags'=>$tags,
        ]);
    }

    public function recipe_edit(Recipe $recipe,CreateData $request){
        $columns=['main_image','display_title','title','time','serve','tag_id','memo'];
        foreach($columns as $column){
            $recipe->$column=$request->$column;
        }
        Auth::user()->recipe()->save($recipe);
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
}