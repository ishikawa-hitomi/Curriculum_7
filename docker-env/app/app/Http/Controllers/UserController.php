<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    //ユーザー詳細画面
    public function show(User $user)
    {
        $users=User::where('id',$user['id'])->with('recipes','follower')->get()->toArray();
        $likes=Like::where('likes.user_id',$user['id'])->whereNull('recipes.deleted_at')->join('recipes','recipe_id','=','recipes.id')->get()->toArray();
        $myfollow=Auth::user()->follower->toArray();
        $myfollow=array_column($myfollow,'following_id');
        $follower=$user->following()->join('users','follower_id','=','users.id')->whereNull('users.deleted_at')->count();
        $following=$user->follower()->join('users','following_id','=','users.id')->whereNull('users.deleted_at')->count();
        return view('user.show',
        [
            'users'=>$users,
            'likes'=>$likes,
            'myfollow'=>$myfollow,
            'follower'=>$follower,
            'follow'=>$following,
        ]);
    }

    //ユーザー情報編集画面
    public function edit(User $user)
    {
        if($user['id']==Auth::user()->id){
            $users=User::where('id','=',$user['id'])->get()->toArray();
            return view('user.edit',[
                'users'=>$users,
            ]);
        }else{
            return redirect(route('recipe.index'));
        }
    }
    //ユーザー情報編集保存
    public function update(Request $request, User $user)
    {
        if(User::where('name',$request->name)->where('id','!=',$user['id'])->exists()){
            return back()->with('user_message', '既に使用されているユーザー名です');
        }elseif(User::where('email',$request->email)->where('id','!=',$user['id'])->exists()){
            return back()->with('user_message', '既に使用されているメールアドレスです');
        }else{
            $columns=['name','email'];
            foreach($columns as $column){
                $user->$column=e($request->$column);
            }
            $user->save();
            return redirect()->route('user.show',['user'=>Auth::user()->id]);
        }
    }

    //プロフィール情報編集画面
    public function profile_edit(User $user)
    {
        if($user['id']==Auth::user()->id){
            $users=User::where('id','=',$user['id'])->get()->toArray();
            return view('user.profile_edit',[
                'users'=>$users,
            ]);
        }else{
            return redirect(route('recipe.index'));
        }
    }
    //プロフィール情報編集保存
    public function profile_update(Request $request, User $user)
    {
        $columns=['profile'];
        foreach($columns as $column){
            $user->$column=e($request->$column);
        }
        $image_path=$request->file('icon');
        if(isset($image_path)){
            \Storage::disk('public')->delete($image_path);
            $image_path=$image_path->store('public');
            $user->icon=basename($image_path);
        }
        $user->save();
        return redirect()->route('user.show',['user'=>Auth::user()->id]);
    }

    //アカウント削除確認画面
    public function delete_show(User $user)
    {
        if($user['id']==Auth::user()->id){
            $users=$user->where('id','=',$user['id'])->with('follower','following','recipes')->get()->toArray();
            return view('user.delete_show',[
                'users'=>$users,
            ]);
        }else{
            return redirect(route('recipe.index'));
        }
    }
    //アカウント削除
    public function destroy(Request $request,User $user)
    {
        if(Hash::check($request->password, $user['password'])){
            $recipes=$user->recipes->toArray();
            foreach($recipes as $recipe){
                Recipe::find($recipe['id'])->delete();
                Step::where('recipe_id',$recipe['id'])->delete();
                Ingredient::where('recipe_id',$recipe['id'])->delete();
                Comment::where('recipe_id',$recipe['id'])->delete();
                Like::where('recipe_id',$recipe['id'])->delete();
            }
            Comment::where('user_id',$user['id'])->delete();
            Like::where('user_id',$user['id'])->delete();
            Follow::where('follower_id',$user['id'])->orwhere('following_id',$user['id'])->delete();
            $user->delete();
            Auth::logout();
            return redirect(route('login'));
        }else{
            return back()->with('delete_user_message', 'パスワードが一致しません');
        }
    }

    //ユーザー情報編集画面
    public function pass_edit(User $user)
    {
        if($user['id']==Auth::user()->id){
            $users=User::where('id','=',$user['id'])->get()->toArray();
            return view('user.pass_edit',[
                'users'=>$users,
        ]);
        }else{
            return redirect(route('recipe.index'));
        }
    }
    //ユーザー情報編集保存
    public function pass_update(Request $request, User $user)
    {
        if(Hash::check($request->now_password, $user['password'])){
            $user->password=e(Hash::make($request->password));
            if($request->password==$request->conf_password){
                $user->save();
            }else{
                return back()->with('pass_edit_message', '新しいパスワードと新しいパスワード（確認）が一致しません');
            }
        }else{
            return back()->with('pass_edit_message', '現在のパスワードが一致しません');
        }
        return redirect()->route('user.show',['user'=>Auth::user()->id]);
    }
}
