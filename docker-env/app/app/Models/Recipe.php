<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable=['main_image','display_title','title','time','serve','tag_id','memo','del_flg'];

    public function tag(){
        return $this->belongsTo('App\Models\Tag','tag_id','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function ingredient(){
        return $this->hasMany('App\Models\Ingredient','id','recipe_id');
    }
    public function step(){
        return $this->hasMany('App\Models\Step','id','recipe_id');
    }

    public function like(){
        return $this->hasMany('App\Models\Like','id','recipe_id');
    }
}
