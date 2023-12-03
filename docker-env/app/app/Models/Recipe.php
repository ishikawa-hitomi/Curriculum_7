<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable=['main_image','display_title','title','time','serve','tag_id','memo','del_flg'];

    public function tag(){
        return $this->belongsTo('App\Models\Tag','tag_id','id');
    }
}
