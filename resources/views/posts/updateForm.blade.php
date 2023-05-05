<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <head>
            <h1 class="page-header">Laravelを使った投稿機能の実装</h1>
        </head>
        <div class="container">
            <h2 class='page-header'>投稿内容を変更する</h2>
            {!! Form::open(['url' => '/update']) !!}
            <div class="form-group">
                {!! Form::hidden('id', $post->id) !!}
                {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary pull-right">更新</button>
            {!! Form::close() !!}
        </div>
        <footer>
            <small>Laravel@test.curriculum</small>
        </footer>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>
</html>