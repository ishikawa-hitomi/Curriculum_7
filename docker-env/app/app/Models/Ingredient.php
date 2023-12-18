<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','quantity','recipe_id'];

    public $timestamps=false;

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
