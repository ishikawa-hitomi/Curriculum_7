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

class AdminController extends Controller
{
    public function index()
    {
        $users=User::with('recipes','likes','follower','following')->get()->toArray();
        $del_users=User::onlyTrashed()->whereNotNull('id')->with('recipes','likes','follower','following')->get()->toArray();
        return view('admin.index',
        [
            'users'=>$users,
            'del_users'=>$del_users,
        ]);
    }

    public function show(User $user)
    {
        $users=User::where('users.id','=',$user['id'])->with('recipes','follower','following')->get()->toArray();
        var_dump($users);
        return view('admin.show',
        [
            'users'=>$users,
        ]);
    }

    public function forceDelete(User $user)
    {
        //完全削除
    }

    public function restore(User $user)
    {
        User::onlyTrashed()->whereNotNull('id')->where('users.id','=',$user['id'])->restore();
        return redirect(route('admin.index'));

    }
}
