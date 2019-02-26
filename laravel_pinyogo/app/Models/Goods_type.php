<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_type extends Model
{
    protected $fillable = ['goods_type','parent_id','level'];

}
