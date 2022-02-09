@extends('layouts.logged_in')

@section('content')
 <h1>{{ $title }}</h1>
 <dl>
     <dd>
       @if($user->image !== '')
            <img src="{{ asset('storage/' . $user->image) }}">
        @else
            <img src="{{ asset('images/no_profile.jpg') }}">
        @endif
        <!--画像編集-->
        <a href="{{ route('profile.edit_image') }}">画像編集</a>
    </dd>
    <dd>{{ $user->name }}さん
        <!--プロフィール編集画面-->
        <a href="{{ route('profile.edit') }}">プロフィール編集</a>
    </dd>
    <dd>
        {{ $user->profile }}
    </dd>
    <dd>
        出品数:{{ $count }}
    </dd>
 </dl>
 <h2>購入履歴</h2>
 <ul>
 @foreach($user->orders as $order)
 <li>{{ $order->item->name }}:{{ $order->item->price}}出品者{{ $order->item->user->name }}</li>
 @endforeach
 </ul>
 @endsection