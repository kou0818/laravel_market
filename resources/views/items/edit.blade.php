@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.update', $item) }}">
      @csrf
      @method('patch')
      <div>
          <label>
            商品名：<br>
            <input type="text" name="name" value="{{ $item->name }}">
          </label>
      </div>
      <div>
          <lebel>
            商品説明：<br>
            <textarea name="description" rows="4" >{{ $item->description}}</textarea>
          </lebel>
      </div>
      <div>
          <lebel>
            価格：<br>
            <input type="number" name='price' value="{{ $item->price }}">
          </lebel>
      </div>
      <div>
          <select name="category_id">
              @foreach($categories as $category)
              <option value="{{ $category->id }}" 
              @if($category->id === $item->category_id)
              selected
              @endif
              >{{ $category->name }}</option>
              @endforeach
          </select>
      </div>
 
      <input type="submit" value="出品">
  </form>
@endsection