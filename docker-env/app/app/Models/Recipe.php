<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['main_image','display_title','title','time','serve','tag_id','memo','del_flg'];

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
    public function steps(){
        return $this->hasMany(Step::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }


    public function getUser(){
        $user=$this->user;
        return $user;
    }

    public function getIngredients(){
        $ingredients=$this->ingredients;
        return $ingredients;
    }

    public function getSteps(){
        $steps=$this->steps;
        return $steps;
    }
}
