@if (isset($rating))
    @for ($i = 1; $i <= 5; $i++)
        {{$i<=floor($rating)? '★' : '☆'}}

    @endfor
@else
    还没有评分
@endif