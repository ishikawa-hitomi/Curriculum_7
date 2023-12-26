<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment_create_form(Recipe $recipe){
        return view('comment.comment_create_form',[
            'recipeId'=>$recipe['id'],
        ]);
    }

    public function comment_create(Recipe $recipe,Request $request){
        $comment=new Comment;
        $columns=['comment','user_id','recipe_id'];
        foreach($columns as $column){
            $comment->$column=e($request->$column);
        }
        $comment->save();
        return redirect(route('recipe.show',['recipe'=>$recipe['id']]));
    }

    public function show(Recipe $recipe)
    {
        $comments=Comment::where('recipe_id',$recipe['id'])->with('user')->get()->toArray();
        return view('comment.show',
        [
            'comments'=>$comments,
        ]);
    }

    public function edit(Comment $comment)
    {
        if($comment['user_id']==Auth::user()->id){
            $comments=Comment::where('id',$comment['id'])->get()->toArray();
            return view('comment.edit',
            [
                'comments'=>$comments,
            ]);
        }else{
            return redirect(route('comment.show',['recipe'=>$comment['recipe_id']]));
        }
    }

    public function update(Request $request,Comment $comment)
    {
        $columns=['comment','user_id','recipe_id'];
        foreach($columns as $column){
            $comment->$column=e($request->$column);
        }
        $comment->save();
        return redirect(route('comment.show',['recipe'=>$comment['recipe_id']]));
    }

    public function destroy(Comment $comment)
    {
        if($comment['user_id']==Auth::user()->id){
            Comment::where('id',$comment['id'])->delete();
            Comment::onlyTrashed()->where('id',$comment['id'])->forceDelete();
        }
        return redirect(route('comment.show',['recipe'=>$comment['recipe_id']]));
    }
}
