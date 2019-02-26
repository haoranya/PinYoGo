<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','phone','province','city','county','address_name','zip_code'];
}
