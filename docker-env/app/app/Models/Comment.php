<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['user_id','recipe_id','comment'];

    public function recipe(){
        return $this->hasMany('App\Models\Recipe','id','recipe_id');
    }

    public function user(){
        return $this->hasMany('App\Models\User','id','user_id');
    }
}
