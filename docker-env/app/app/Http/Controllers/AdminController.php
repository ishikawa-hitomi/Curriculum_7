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
        $users=User::withTrashed()->whereNotNull('id')->with('recipes','likes','follower','following')->get()->toArray();
        return view('admin.index',
        [
            'users'=>$users,
        ]);
    }

    public function show(User $user)
    {
        $users=User::withTrashed()->whereNotNull('id')->where('users.id','=',$user['id'])->with('recipes','follower','following')->get()->toArray();
        var_dump($users);
        return view('admin.show',
        [
            'users'=>$users,
        ]);
    }

    public function destroy(User $user)
    {
        //完全削除
    }
}
