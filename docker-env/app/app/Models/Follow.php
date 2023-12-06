<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable=['follow_user_id','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public $timestamps=false;
}
