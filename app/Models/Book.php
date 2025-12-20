<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    //设定跟reviews表的关系，1对多，所以函数名要加reviews不能是review
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    //范围查询 必须以scope开头,直接在php artisan tinker中使用 App\Models\Book::title('doloremque')->get();
    public function scopeTitle(Builder $query,String $title):Builder{
        return $query->where('title', 'LIKE', "%$title%");
    }
}
