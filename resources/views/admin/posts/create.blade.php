@extends('layouts.app')

@section('pageTitle', 'Create New Post')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('admin.posts.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="category_id" id="category">
                            <option value="">Select a category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if ($category->id == old('category_id')) selected @endif>
                                    {{ $category->id }} - {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Url - Insert a valid URL. Ex: https://picsum.photos/id/1/400/300</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Create post</button>
                    <a href="{{ url()->previous() }}" class="btn btn-primary fw-bold">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
