<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Library\CloudinaryUpload;

class AdminController extends Controller
{
    public function user_index(Request $request)
    {
        $users=User::sortable()->with('recipes','likes','follower','following');
        //ユーザーの検索
        $user_id=e($request->input('user_id'));
        $from=e($request->input('from'));
        $to=e($request->input('to'));
        if(!empty($user_id)){
            $users->where('id','LIKE','%'.$user_id.'%');
        }
        if(!empty($from)){
            $users->where('created_at','>=',$from);
        }
        if(!empty($to)){
            $users->where('created_at','<=',$to);
        }
        $users=$users->get()->toArray();
        return view('admin.user_index',
        [
            'users'=>$users,
        ]);
    }

    public function del_user_index(Request $request){
        //削除後30日経過したユーザーを完全に削除
        $d_users=User::onlyTrashed()->get()->toArray();
        $now=Carbon::now();
        foreach($d_users as $del){
            $date=$now->diffInDays($del['deleted_at']);
            if($date>30){
                CloudinaryUpload::user_forceDelete($del['id']);
            }
        }
        //削除したユーザーを復元
        $restore=e($request->input('restore'));
        if(!empty($restore)){
            CloudinaryUpload::user_restore($restore);
            return redirect(route('admin.user_index'));
        }
        //削除したユーザーを完全に削除
        $forceDelete=e($request->input('forceDelete'));
        if(!empty($forceDelete)){
            CloudinaryUpload::user_forceDelete($forceDelete);
            return redirect(route('admin.user_index'));
        }
        //ユーザーの検索
        $users=User::onlyTrashed();
        $user_id=e($request->input('user_id'));
        $from=e($request->input('from'));
        $to=e($request->input('to'));
        if(!empty($user_id)){
            $users->where('id','LIKE','%'.$user_id.'%');
        }
        if(!empty($from)){
            $users->where('deleted_at','>=',$from);
        }
        if(!empty($to)){
            $users->where('deleted_at','<=',$to);
        }
        $del_users=$users->sortable()->get()->toArray();
        $inquiry=Inquiry::where('category',2)->get()->toArray();
        return view('admin.del_user_index',
        [
            'del_users'=>$del_users,
            'now'=>$now,
            'pass'=>'00000000',
            'inquiry'=>$inquiry,
        ]);
    }

    public function recipe_index(Request $request)
    {
        $recipes=Recipe::sortable()->with('user','likes','comments');
        //ユーザーの検索
        $id=e($request->input('id'));
        if(!empty($id)){
            $recipes->where('id',$id);
        }
        $user_id=e($request->input('user_id'));
        if(!empty($user_id)){
            $recipes->where('user_id','LIKE','%'.$user_id.'%');
        }
        $display_title=e($request->input('display_title'));
        if(!empty($display_title)){
            $recipes->where('display_title','LIKE','%'.$display_title.'%');
        }
        $title=e($request->input('title'));
        if(!empty($title)){
            $recipes->where('title','LIKE','%'.$title.'%');
        }
        $from=e($request->input('from'));
        if(!empty($from)){
            $recipes->where('created_at','>=',$from);
        }
        $to=e($request->input('to'));
        if(!empty($to)){
            $recipes->where('recipes.created_at','<=',$to);
        }
        $recipes=$recipes->get()->toArray();
        return view('admin.recipe_index',
        [
            'recipes'=>$recipes,
        ]);
    }

    public function del_recipe_index(Request $request){
        //削除したレシピを復元
        $restore=e($request->input('restore'));
        if(!empty($restore)){
            CloudinaryUpload::recipe_restore($restore);
            return redirect(route('admin.del_recipe_index'));
        }
        //削除したレシピを完全に削除
        $forceDelete=e($request->input('forceDelete'));
        if(!empty($forceDelete)){
            CloudinaryUpload::recipe_forceDelete($forceDelete);
            return redirect(route('admin.del_recipe_index'));
        }
        $recipes=Recipe::onlyTrashed()->with('user');
        //削除後30日経過したレシピを完全に削除
        $d_recipes=$recipes->get()->toArray();
        $now=Carbon::now();
        foreach($d_recipes as $del){
            $date=$now->diffInDays($del['deleted_at']);
            if($date>30){
                CloudinaryUpload::recipe_forceDelete($del['id']);
            }
        }
        //レシピを検索
        $id=e($request->input('id'));
        if(!empty($id)){
            $recipes->where('recipes.id',$id);
        }
        $user_id=e($request->input('user_id'));
        if(!empty($user_id)){
            $recipes->where('user_id','LIKE','%'.$user_id.'%');
        }
        $display_title=e($request->input('display_title'));
        if(!empty($display_title)){
            $recipes->where('recipes.display_title','LIKE','%'.$display_title.'%');
        }
        $title=e($request->input('title'));
        if(!empty($title)){
            $recipes->where('recipes.title','LIKE','%'.$title.'%');
        }
        $from=e($request->input('from'));
        if(!empty($from)){
            $recipes->where('recipes.deleted_at','>=',$from);
        }
        $to=e($request->input('to'));
        if(!empty($to)){
            $recipes->where('recipes.deleted_at','<=',$to);
        }
        $del_recipes=$recipes->sortable()->with('user')->get()->toArray();
        $inquiry=Inquiry::where('category',3)->get()->toArray();
        return view('admin.del_recipe_index',
        [
            'del_recipes'=>$del_recipes,
            'now'=>$now,
            'pass'=>'00000000',
            'inquiry'=>$inquiry,
        ]);
    }

    public function user_delete(User $user)
    {
        //完全削除
        $recipes=$user->recipes->toArray();
            foreach($recipes as $recipe){
                Recipe::where('id',$recipe['id'])->delete();
                Step::where('recipe_id',$recipe['id'])->delete();
                Ingredient::where('recipe_id',$recipe['id'])->delete();
                Comment::where('recipe_id',$recipe['id'])->delete();
                Like::where('recipe_id',$recipe['id'])->delete();
            }
            Comment::where('user_id',$user['id'])->delete();
            Like::where('user_id',$user['id'])->delete();
            Follow::where('follower_id',$user['id'])->orwhere('following_id',$user['id'])->delete();
            $user->delete();
            return redirect(route('admin.user_index'));
    }
}
