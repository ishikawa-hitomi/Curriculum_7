<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable=['answer','question','email','user_name','user_email','user_pass','category'];

    public $timestamps=false;
}
