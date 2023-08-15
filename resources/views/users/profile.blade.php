@extends('layouts.login')

@section('content')

<div class="card w-50 mx-auto m-5">
    <div class="card-body">
        <form action=""method="get">
            <div class="form-group pt-2">
                @csrf
                <p>user name</p>
                <input type="text" name="username" value="{{ $user->username }}" />
                <p>mail adress</p>
                <input type="text" name="mail" value="{{ $user->mail }}" />
                <p>password</p>
                <input type="password" name="password" />
                <p>password comfirm</p>
                <input type="password" name="password" />
                <p>bio</p>
                <input type="text" name="bio" value="{{ $user->bio }}" />
                <p>icon image</p>
                <input type="text" name="images" value="{{ $user->images }}" />
            </div>
            <div class="form-group pull-right">
                {{Form::submit(' 更新 ', ['class'=>'btn btn-success rounded-pill'])}}
            </div>
        </form>
    </div>
</div>

@endsection