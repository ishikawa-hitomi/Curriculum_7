<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    //メイン画面、検索結果画面
    public function index(Request $request)
    {
        $recipes=Recipe::with('user','likes')->whereNull('recipes.deleted_at');
        //新着レシピ6件
        $new_recipes=Recipe::with('user','likes')->whereNull('recipes.deleted_at')->latest()->take(6)->get()->toArray();
        //いいねが多いレシピ6件
        $good_recipes=Recipe::with('user')->leftJoin('likes', 'recipes.id', '=', 'likes.recipe_id')->select('recipes.id','recipes.user_id','recipes.display_title','recipes.main_image', DB::raw("count(likes.recipe_id) as count"))->groupBy('recipes.id')->orderBy('count','desc')->take(6)->get()->toArray();
        //検索があった場合
            $keyword=e($request->input('keyword'));
            $from=e($request->input('from'));
            $to=e($request->input('to'));
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
            $search_recipes=$recipes->paginate(10);
        return view('recipe.index',
        [
            'search_recipes'=>$search_recipes,
            'new_recipes'=>$new_recipes,
            'good_recipes'=>$good_recipes,
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
            $recipe->$column=e($request->$column);
        }
        $recipe->user_id=Auth::user()->id;
        $image_path=$request->file('main_image')->store('public');
        $recipe->main_image=basename($image_path);
        session()->put('recipe',$recipe);
        return redirect(route('ingredient.create'));
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
            $recipe->$column=e($request->$column);
        }
        $image_path=$request->file('main_image');
        if(isset($image_path)){
            \Storage::disk('public')->delete($image_path);
            $image_path=$image_path->store('public');
            $recipe->main_image=basename($image_path);
        }
        Auth::user()->recipes()->save($recipe);
        return redirect(route('ingredient.edit',['recipe'=>$recipe['id']]));
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
        $user=$recipe['user_id'];
        Recipe::find($recipe['id'])->delete();
        Step::where('recipe_id',$recipe['id'])->delete();
        Ingredient::where('recipe_id',$recipe['id'])->delete();
        Comment::where('recipe_id',$recipe['id'])->delete();
        Like::where('recipe_id',$recipe['id'])->delete();
        return redirect(route('user.show',['user'=>$user]));
    }
}
