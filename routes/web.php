<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->route('books.index');
});

//php artisan make:controller  BookController --resource //使用这个命令添加控制器还需要添加资源路由
Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource("books.reviews", ReviewController::class)->scoped(['review' => 'book'])->only(['create', 'store']);

// 没有 scoped() 时，路由参数是：
// /books/{book}/reviews/{review}

// 启用 scoped(['review' => 'book']) 后：
// /books/{book}/reviews/{review}
// 但 Laravel 会自动确保 {review} 属于 {book}

// 2. ->scoped(['review' => 'book'])
// 作用域限定：确保获取的 review 确实属于指定的 book
// 它会自动验证：review 记录必须属于 book 记录
// 实际效果：在控制器中，Laravel 会执行类似这样的查询：
// php
// // 自动检查 review 是否属于 book
// $book = Book::find($bookId);
// $review = $book->reviews()->where('id', $reviewId)->first();
// // 如果 review 不属于这个 book，会抛出 404