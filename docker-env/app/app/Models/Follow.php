<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['following_id','follower_id'];

    public function following(){
        return $this->belongsTo(User::class,'following_id');
    }

    public function follower(){
        return $this->belongsTo(User::class,'follower_id');
    }

    public $timestamps=false;


    public function getFollowing(){
        $following=$this->following;
        return $following;
    }

    public function getFollower(){
        $follower=$this->follower;
        return $follower;
    }
}
