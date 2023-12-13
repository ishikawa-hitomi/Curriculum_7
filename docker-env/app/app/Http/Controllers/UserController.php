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
use App\Http\Requests\CreateData;
use App\Http\Requests\UserData;
use App\Http\Requests;

class UserController extends Controller
{
    //ユーザー詳細画面
    public function show(User $user)
    {
        $users=User::where('id',$user['id'])->with('recipes','follower')->get()->toArray();
        $likes=Like::where('likes.user_id',$user['id'])->whereNull('deleted_at')->join('recipes','recipe_id','=','recipes.id')->get()->toArray();
        $myfollow=Auth::user()->follower->toArray();
        $myfollow=array_column($myfollow,'following_id');
        $follower=$user->following()->join('users','follower_id','=','users.id')->where('deleted_at',null)->count();
        $following=$user->follower()->join('users','following_id','=','users.id')->where('deleted_at',null)->count();
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
        $users=User::where('id','=',$user['id'])->get()->toArray();
        return view('user.edit',[
            'users'=>$users,
        ]);
    }
    //ユーザー情報編集保存
    public function update(Request $request, User $user)
    {
        $columns=['name','email'];
        foreach($columns as $column){
            $user->$column=$request->$column;
        }
        $user->save();
        return redirect()->route('user.show',['user'=>Auth::user()->id]);
    }

    //プロフィール情報編集画面
    public function profile_edit(User $user)
    {
        $users=User::where('id','=',$user['id'])->get()->toArray();
        return view('user.profile_edit',[
            'users'=>$users,
        ]);
    }
    //プロフィール情報編集保存
    public function profile_update(Request $request, User $user)
    {
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
        return redirect()->route('user.show',['user'=>Auth::user()->id]);
    }

    //アカウント削除確認画面
    public function delete_show(User $user)
    {
        $users=$user->where('id','=',$user['id'])->get()->toArray();
        return view('user.delete_show',[
            'users'=>$users,
        ]);
    }
    //アカウント削除
    public function destroy(User $user)
    {
        $user->delete();
        Recipe::where('user_id','=',$user['id'])->delete();
        Auth::logout();
        return redirect(route('login'));
    }
}
