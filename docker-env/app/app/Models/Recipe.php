<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    protected $fillable=['main_image','display_title','title','time','serve','tag_id','memo','del_flg'];

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

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
