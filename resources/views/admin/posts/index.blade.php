@extends('layouts.app')

@section('pageTitle', 'Admin Control Panel')

@section('content')

    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-danger">{{ session('deleted') }}</div>
        @endif

        <div class="row">
            <div class="col">
                <h1>Admin Control Panel</h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col d-flex justify-content-end">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add a new post</a>
            </div>
        </div>

        <form action="" method="get" class="row d-flex flex-column gy-3 mb-5">
            <div class="col-3 mb-2">
                <label for="search-string" class="form-label mb-0">Text to search:</label>
                <input type="text" class="form-control" id="search-string" name="search" value="{{ $request->search }}">
            </div>

            <div class="col-3 mb-2">
                <label for="category" class="form-label mb-0">Category:</label><br>
                <select class="form-select" aria-label="Default select example" name="category" id="category">
                    <option value="" selected>Select a category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $request->category) selected @endif>{{ $category->id }} - {{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 mb-2">
                <label for="author" class="form-label mb-0">Author:</label><br>
                <select class="form-select" aria-label="Default select example" name="author" id="author">
                    <option value="" selected>Select an author</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $request->author) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <button class="btn btn-primary">Apply filters</button>
            </div>
        </form>

        <div class="row bg-dark text-white">
            <div class="col-1 d-flex align-items-center border py-1">
                <h5 class="my-0">#id</h5>
            </div>
            <div class="col-3 d-flex align-items-center border py-1">
                <h5 class="my-0">Title</h5>
            </div>
            <div class="col-2 d-flex align-items-center border py-1">
                <h5 class="my-0">Slug</h5>
            </div>
            <div class="col-1 d-flex align-items-center border py-1">
                <h5 class="my-0">Category</h5>
            </div>
            <div class="col-1 d-flex align-items-center border py-1">
                <h5 class="my-0">Author</h5>
            </div>
            <div class="col-1 d-flex align-items-center border py-1">
                <h5 class="my-0">Last Edit</h5>
            </div>
            <div class="col-3 d-flex align-items-center border py-1">
                <h5 class="my-0">Options</h5>
            </div>
        </div>

        @foreach ($posts as $post)
            <div class="row bg-secondary">
                <div class="col-1 d-flex align-items-center border py-1">
                    <p class="my-0">{{ $post->id }}</p>
                </div>
                <div class="col-3 d-flex align-items-center border py-1">
                    <p class="my-0">{{ $post->title }}</p>
                </div>
                <div class="col-2 d-flex align-items-center border py-1">
                    <p class="my-0">{{ $post->slug }}</p>
                </div>
                <div class="col-1 d-flex align-items-center border py-1">
                    <p class="my-0">{{ $post->category->category }}</p>
                </div>
                <div class="col-1 d-flex align-items-center border py-1">
                    <p class="my-0">{{ $post->user->name }}</p>
                </div>
                <div class="col-1 d-flex align-items-center border py-1">
                    <p class="my-0">{{ date('d/m/Y', strtotime($post->updated_at)) }}</p>
                </div>
                <div class="col-3 d-flex flex-wrap justify-content-between align-items-center border py-1">
                    <a class="btn btn-primary d-flex flex-column align-items-center" href="{{ route('admin.posts.show', $post->slug) }}"><i class="fa-solid fa-eye"></i> View</a>
                    {{-- Bottoni edit e view visibili solo sui propri posts --}}
                    @if (Auth::user()->id === $post->user_id)
                        <a class="btn btn-primary d-flex flex-column align-items-center" href="{{ route('admin.posts.edit', $post->slug) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <button class="btn btn-danger btn-delete d-flex flex-column align-items-center" data-slug="{{ $post->slug }}"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="row mt-3">
            <div class="col d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- POPUP ELIMINAZIONE POST --}}
        <section id="show-popup" class="overlay d-none">
            <div class="popup">
                <h1>You're deleting this post. Are you sure?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary mr-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">YES</button>
                    </form>
                </div>
            </div>
        </section>
        {{-- FINE POPUP ELIMINAZIONE POST --}}
    </div>

@endsection
