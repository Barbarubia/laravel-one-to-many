@extends('layouts.app')

@section('pageTitle', $post->title)

@section('content')
    <div class="container">
        @if (session('created'))
            <div class="alert alert-success">{{ session('created') }}</div>
        @endif
        @if (session('modified'))
            <div class="alert alert-success">{{ session('modified') }}</div>
        @endif
        <div class="row">
            <div class="col">
                <h1>{{ $post->title }}</h1>
                <small>(Created at: {{ $post->created_at }}
                @if ($post['updated_at'] != $post['created_at'])
                    - Last update at: {{ $post->updated_at }}
                @endif
                )
                </small>
                <br>
                @if ($post['image'] != null)
                    <img src="{{ $post->image }}" alt="{{ $post->title }}">
                @endif

                <p>{{ $post->content }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <a href="{{ url()->previous() }}" class="btn btn-primary fw-bold">Go Back</a>
            </div>
        </div>
    </div>
@endsection
