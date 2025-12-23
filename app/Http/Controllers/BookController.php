<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function PHPUnit\Framework\returnArgument;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');//没有指定数值，默认为''
        //when方法的第一个参数若为空则不会执行function，而是直接执行get()获取所有数据
        $books = Book::when($title, function ($query, $title) {
            return $query->title($title);//这边的title方法是引用自Book模型的scopeTitle方法
        });

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()
        };
        // $books = $books->get();
        //使用缓存
        //$books = Cache::remember('books', 60, fn() => $books->get());
        //或者使用
        $cacheKey = 'books:' . $filter . ':' . $title;
        $books = cache()->remember($cacheKey, 60, fn() => $books->get());
        return view('books.index', ["books" => $books]);
        //return view('books.index', compact('books'));//compact('books')将会把$books变量传递给视图
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    //不需要ion show(string $id) $id参数，直接传递Book模型,laravel会自动匹配路$id
    public function show(Book $book)
    {
        $cacheKey = 'book:' . $book->id;
        $book = cache()->remember($cacheKey, 60, fn() => $book->load(['reviews' => fn($query) => $query->latest()]));

        //默认Book $book会加载reviews因为在Book模型中定义了reviews()方法，但是获取的reviews是没有按照created_at排序的，所以需要使用load()方法加载reviews并排序
        return view('books.show', [
            "book" => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
