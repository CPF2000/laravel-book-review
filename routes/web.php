<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   dd();
});

//php artisan make:controller  BookController --resource //使用这个命令添加控制器还需要添加资源路由
Route::resource('books', BookController::class);