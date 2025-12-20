<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    //设置跟books数据表的关联关系，多个reviews对应一个 book，函数名为单数book，不能为books
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
