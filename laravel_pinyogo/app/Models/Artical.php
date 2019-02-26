<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    protected $fillable = ['title','sort','desc','type','content'];
}
