@extends('layouts.login')

@section('content')
{!! Form::open(['url' => '/follow-list']) !!}

    @foreach($posts as $post)
    <p>名前:{{ $post->user->username }}</p>
    <p>投稿内容:{{ $post->post }}</p>
    @endforeach

@endsection

