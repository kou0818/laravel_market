@extends('layouts.logged_in')
 
@section('content')
<h1>{{ $title }}</h1>
  <a href="{{ route('items.create') }}">新規出品</a>
  <ul class="items">
      @forelse($items as $item)
          <li class="item">
              <a href ="{{ route('items.show', $item)}}">
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
              
                  [<a href="{{ route('items.edit', $item) }}">編集</a>]
                  [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]
                  <form method="post" class="delete" action="{{ route('items.destroy', $item) }}">
                  @csrf
                  @method('delete')
                  <input type="submit" value="削除">
                  </form>
              </div>
          </li>
      @empty
          <li>出品している商品がありません。</li>
      @endforelse
  </ul>
@endsection