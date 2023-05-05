@extends('layouts.login')

@section('content')
{!! Form::open(['url' => 'search','class' => 'post-form']) !!}
    {{ Form::input('text','keyword',null, ['required','class' => 'search','placeholder' => 'ユーザー名']) }}
    <button type="submit"><img src="images/post.png " width="100" height="100"></button>
    @if(!empty($keyword))
        <div class="search-word">
            検索ワード:{{ $keyword }}
        </div>
    @endif
{!! Form::close() !!}
<div class="search-form">
    @foreach($user as $user)
    @if ($user->id !== Auth::user()->id)
        <tr>
            <td><img src="/storage/{{ $user->images }}">
                {{ $user->username}}
                @if (auth()->user()->isFollowing($user->id))
                    <form action="{{ route('unFollow', ['id' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>
                @else
                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">フォローする</button>
                    </form>
                @endif
            </td>
        </tr>
    @endif
    @endforeach
</div>
@endsection
