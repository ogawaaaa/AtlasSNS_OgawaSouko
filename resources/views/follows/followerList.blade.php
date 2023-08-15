@extends('layouts.login')

@section('content')

<div class="container">
    <section class="follow-list">
        <h1>Follower List</h1>
        @foreach($follows as $follow)
            <p>名前：{{ $follow->username }}</p>
            <p>名前：{{ $follow->post }}</p>
        @endforeach
    </section>
</div>

@endsection

