@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf
      <div>
          <label>
            商品名：<br>
            <input type="text" name="name">
          </label>
      </div>
      <div>
          <lebel>
            商品説明：<br>
            <textarea name="description" rows="4"></textarea>
          </lebel>
      </div>
      <div>
          <lebel>
            価格：<br>
            <input type="number" name='price'>
          </lebel>
      </div>
      <div>
          <select name="category_id">
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
          </select>
      </div>
      <div>
          <label>
            画像を選択:
            <input type="file" name="image">
            
          </label>
      </div>
 
      <input type="submit" value="出品">
  </form>
@endsection