@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

<form method="post" action="{{ route('items.confirm', $item) }}">
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
    @if($item->isSoldOut())
    売り切れ
    @else
    <input type="submit" value="購入する">
    @endif
</dl>
</form>
@endsection