<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //设定跟reviews表的关系，1对多，所以函数名要加reviews不能是review
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
