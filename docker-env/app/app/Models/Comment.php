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
        return $this->hasMany('App\Models\Recipe','recipe_id','id');
    }
}
