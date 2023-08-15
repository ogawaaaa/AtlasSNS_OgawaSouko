@extends('layouts.login')

@section('content')

<div class="container">
    <section class="follow-list">
        <h1>Follow List</h1>
        @foreach($follows as $follow)
            <ul>
                <li>
                    <div class="follows_icon"><img src="{{ asset('storage/'.$follow->images) }}"></div>
                </li>
                <p>{{ $follow->username }}</p>
                <p>{{ $follow->post }}</p>
                <p>{{ $follow->created_at }}</p>
            </ul>
        @endforeach
    </section>
</div>

@endsection