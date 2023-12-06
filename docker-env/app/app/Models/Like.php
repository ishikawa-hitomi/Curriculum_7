<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable=['recipe_id','user_id'];

    public function recipe(){
        return $this->belongsTo('App\Models\Recipe','recipe_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public $timestamps=false;
}
