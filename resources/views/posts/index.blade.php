@extends('layouts.login')

@section('content')
<!doctype html>
    <div id="container">
        <img src="images/icon1.png">
        @csrf
        <form method="POST" action="{{ url('/store') }}">
            <p>投稿内容</p>
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-horizontal">
            </div>
            <textarea name="main" cols="40" rows="10"></textarea>
            <button type="submit" class="btn btn-success pull-right" onclick="location.href='/store'"><img src="images/post.png"></button>
        </form>
    </div>
    <div class="post-wrapper">
        @foreach($post as $post)
        <tr>
            <td>{{ $post->user_id }}</td>
            <td>{{ $post->post }}</td>
            <td>{{ $post->created_at }}</td>
            <td><a class="btn btn-primary" href="/post/{{$post->id}}/update-form">更新</a></td>
            <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
        </tr>
        @endforeach
    </div>
</html>
@endsection