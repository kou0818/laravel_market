@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

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
    <a href="{{ url('/') }}">トップに戻る</a>
</dl>

@endsection