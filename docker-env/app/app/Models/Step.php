<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['procedure','sub_image','recipe_id'];

    public $timestamps=false;

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
