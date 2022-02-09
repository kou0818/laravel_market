@extends('layouts.logged_in')
 
@section('content')
  <a href="{{ route('items.create') }}">新規出品</a>
  <ul class="items">
      @forelse($items as $item)
          <li class="item">
              <a href="{{ route('items.show', $item) }}">
                    @if($item->isSoldOut())
                     売り切れ
                    @else
                     出品中
                    @endif
                    
                    @if($item->image !== '')
                        <img src="{{ asset('storage/' . $item->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                    {{ $item->description }}
              </a>
              <div class="item_body_main_name">
                  {{ $item->name }} {{ $item->price }}
              </div>
              <div class="item_body_main_footer">  
                  カテゴリ：{{ $item->category->name }}({{ $item->created_at }})
                  <a class="like_button">{{ $item->isLikeBy(Auth::user()) ? '★' : '☆' }}</a>
                  <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                    @csrf
                    @method('patch')
                  </form>
              </div>
          </li>
      @empty
          <li>商品がありません。</li>
      @endforelse
  </ul>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
  </script>
@endsection