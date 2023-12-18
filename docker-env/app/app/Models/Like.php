<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['recipe_id','user_id'];

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $timestamps=false;


    public function getLikedRecipe(){
        $likedRecipe=$this->recipe;
        return $likedRecipe;
    }

    public function getLikedUser(){
        $likedUser=$this->user;
        return $likedUser;
    }
}
