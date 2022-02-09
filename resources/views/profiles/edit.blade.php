@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>

<!--編集フォーム-->
<form method="POST" action="{{ route('profile.update', $user) }}">
    @csrf
    @method('patch')
    <div>
        <label>
            名前:<br>
            <input type="text" name="name" value="{{ $user->name }}">
        </label>
    </div>
    <div>
        <label>
            プロフィール:<br>
            <textarea type="text" name="profile" cols="40" rows="10">{{ $user->profile }}</textarea>
        </label>
    </div>
    <input type="submit" value="変更">
</form>
@endsection