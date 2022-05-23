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
                <h1 class="text-capitalize">{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-between mb-3">
            <div class="col-3 p-3">
                <h6>Info post:</h6>
                <small>Category: {{ $post->category->category }}</small><br>
                <small>Created: {{ $post->created_at->format('d-m-Y H:i') }}</small>
                @if ($post['updated_at'] != $post['created_at'])
                    <br>
                    <small>Last update: {{ $post->updated_at->format('d-m-Y H:i') }}</small>
                @endif
            </div>
            <div class="col-3 bg-white border border-info border-5 p-3">
                <h6>About the author:</h6>
                <div class="d-flex justify-content-between">
                    <div>
                        <small>Name: {{ $post->user->name }}</small><br>
                        <small>From: {{ $post->user->userInfo->city }}</small><br>
                        <small>Age: {{ $post->user->userInfo->age() }}</small>
                    </div>
                    <img class="w-25 h-25 rounded-circle" src="{{ $post->user->userInfo->avatar }}" alt="{{ $post->user->name }}'s Avatar">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($post['image'] != null)
                    <img class="mb-3" src="{{ $post->image }}" alt="{{ $post->title }}">
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
