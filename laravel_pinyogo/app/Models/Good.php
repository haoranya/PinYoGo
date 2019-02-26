<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['goods_name','cat_one_id','cat_two_id','cat_three_id','brand_id','price','desc','serve','packing','shop_id','number','seckill_state'];
}
