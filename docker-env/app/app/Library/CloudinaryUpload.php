<?php

namespace app\Library;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\Step;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Follow;

class CloudinaryUpload
{
  public static function user_restore($id) {
    $recipes=Recipe::onlyTrashed()->where('user_id','=',$id)->get()->toArray();
            foreach($recipes as $recipe){
                Ingredient::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Step::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Comment::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Like::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
            }
            Recipe::onlyTrashed()->where('user_id','=',$id)->restore();
            Like::onlyTrashed()->where('user_id','=',$id)->restore();
            Comment::onlyTrashed()->where('user_id','=',$id)->restore();
            Follow::onlyTrashed()->where('follower_id','=',$id)->orwhere('following_id','=',$id)->restore();
            User::onlyTrashed()->where('id','=',$id)->restore();
  }

  public static function user_forceDelete($id) {
    $recipes=Recipe::onlyTrashed()->where('user_id','=',$id)->get()->toArray();
            foreach($recipes as $recipe){
                Ingredient::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Step::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Comment::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Like::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
            }
            Recipe::onlyTrashed()->where('user_id','=',$id)->forceDelete();
            Like::onlyTrashed()->where('user_id','=',$id)->forceDelete();
            Comment::onlyTrashed()->where('user_id','=',$id)->forceDelete();
            Follow::onlyTrashed()->where('follower_id','=',$id)->orwhere('following_id','=',$id)->forceDelete();
            User::onlyTrashed()->where('id','=',$id)->forceDelete();
  }

  public static function recipe_restore($id) {
    $recipes=Recipe::onlyTrashed()->where('id','=',$id)->get()->toArray();
            foreach($recipes as $recipe){
                Ingredient::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Step::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Comment::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
                Like::onlyTrashed()->where('recipe_id','=',$recipe['id'])->restore();
            }
            Recipe::onlyTrashed()->where('id','=',$id)->restore();
  }

  public static function recipe_forceDelete($id) {
    $recipes=Recipe::onlyTrashed()->where('id','=',$id)->get()->toArray();
            foreach($recipes as $recipe){
                Ingredient::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Step::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Comment::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
                Like::onlyTrashed()->where('recipe_id','=',$recipe['id'])->forceDelete();
            }
            Recipe::onlyTrashed()->where('id','=',$id)->forceDelete();
  }
}