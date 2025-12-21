<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
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
    //过滤评论比较多的书
    public function scopePopular(Builder $query):Builder | QueryBuilder{
       return $query->withCount('reviews')->orderBy('reviews_count', 'desc');
    }
    //过滤得分最高的书
    public function scopeHighestRated(Builder $query):Builder | QueryBuilder{
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    }

    private function filterDated(Builder $query,String $from=null,String $to=null){
        if($from && !$to){
            $query->where('created_at', '>=', $from);
        }elseif(!$from && $to){
            $query->where('created_at', '<=', $to);
        }elseif($from && $to){
            $query->whereBetween('created_at', [$from, $to]);
        }
    }


}
