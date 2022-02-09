@extends('layouts.logged_in')

@section('content')
<form method="post" action="{{ route('items.finish', $item) }}">
@csrf
<dl>
    <dt>商品名</dt>
    <dd>{{ $item->name }}</dd>
    <dt>画像</dt>
    <dd>
        @if($item->image !== '')
            <img src="{{ \Storage::url($item->image) }}">
        @else
            画像はありません。
        @endif
    </dd>
    <dt>カテゴリ</dt>
    <dd>{{ $item->category->name }}</dd>
    <dt>価格</dt>
    <dd>{{ $item->price }}</dd>
    <dt>説明</dt>
    <dd>{{ $item->description }}</dd>
    <input type="submit" value="内容を確認して購入する">
</dl>
</form>
@endsection