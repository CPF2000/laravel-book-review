@extends('layouts.app')

@section('content')
<h1 class="mb-10 text-2xl">为《{{ $book->title }}》书本添加评分</h1>
<form method="POST" action="{{route('books.reviews.store', $book)}}">
    @csrf
    <label for="review">评论</label>
    <textarea name="review" id="review" required class="input mb-4"></textarea>
   {{-- {{$errors}} --}}
   
    @error('review')
        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
    @enderror
    <label for="rating">评分 </label>
    <select name="rating" id="rating" class="input mb-4" required>
        <option value="">请选择分数</option>
        @for($i=1; $i<=5; $i++)
            <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>
     @error('rating')
        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn">保存</button>
</form>

@endsection