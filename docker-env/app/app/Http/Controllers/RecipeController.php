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

class RecipeController extends Controller
{
    //メイン画面、検索結果画面
    public function index(Request $request)
    {
        $recipes=Recipe::with('user')->where('deleted_at',null);
        $keyword=$request->input('keyword');
        $from=$request->input('from');
        $to=$request->input('to');
        if(!empty($keyword)){
            $spaceConversion = mb_convert_kana($keyword, 's');
            $wordArray = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach($wordArray as $word){
                $recipes->where('display_title','LIKE','%'.$word.'%')->orwhere('title','LIKE','%'.$word.'%');
            }
        }
        if(!empty($from)){
            $recipes->where('recipes.created_at','>=',$from);
        }
        if(!empty($to)){
            $recipes->where('recipes.created_at','<=',$to);
        }
        $recipes=$recipes->get()->toArray();
        return view('recipe.index',
        [
            'recipes'=>$recipes,
            'keyword'=>$keyword,
            'from'=>$from,
            'to'=>$to,
        ]);
    }

    //レシピ新規投稿画面
    public function create()
    {
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('recipe.create',[
            'tags'=>$tags,
        ]);
    }
    //レシピ新規投稿保存
    public function store(Request $request)
    {
        $recipe=new Recipe;
        $columns=['display_title','title','time','serve','tag_id','memo'];
        foreach($columns as $column){
            $recipe->$column=$request->$column;
        }
        $image_path=$request->file('main_image')->store('public');
        $recipe->main_image=basename($image_path);
        Auth::user()->recipes()->save($recipe);
        return redirect('/ingredient_create/'.$recipe['id']);
    }

    //投稿詳細画面
    public function show(Recipe $recipe)
    {
        $recipes=Recipe::where('id',$recipe['id'])->with('tag','user','ingredients','steps','comments')->get()->toArray();
        $mylikes=Auth::user()->likes->toArray();
        $mylikes=array_column($mylikes,'recipe_id');
        return view('recipe.show',
        [
            'recipes'=>$recipes,
            'mylikes'=>$mylikes,
        ]);
    }

    //レシピ編集画面
    public function edit(Recipe $recipe)
    {
        $result=$recipe->with('tag')->where('id','=',$recipe['id'])->get()->toArray();
        $tag=new Tag;
        $tags=$tag->all()->toArray();
        return view('recipe.edit',[
            'recipes'=>$result,
            'tags'=>$tags,
        ]);
    }
    //レシピ編集保存
    public function update(Request $request, Recipe $recipe)
    {
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
        Auth::user()->recipes()->save($recipe);
        return redirect('/ingredient_edit/'.$recipe['id']);
    }

    //投稿削除確認画面
    public function delete_show(Recipe $recipe)
    {
        $recipes=Recipe::where('id','=',$recipe['id'])->with('tag')->get()->toArray();
        return view('recipe.delete_show',[
            'recipes'=>$recipes,
        ]);
    }
    //投稿倫理削除
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect(route('recipe.index'));
    }
}
