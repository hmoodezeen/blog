@extends('layouts.app')

@section('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? "Update Post" : "Add a new post" }}
    </div>
    <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group" >
                <label for="post title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Add a new title" value="{{ isset($post) ? $post->title : "" }}">
                @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group" >
                <label for="post description">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Add a Description" rows="2" name="description">{{ isset($post) ? $post->description : "" }}</textarea>
                @error('description')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group" >
                <label for="post content">Content:</label>
                
                <input value="{{ isset($post) ? $post->content : "" }}" class="@error('description') is-invalid @enderror" id="x" type="hidden" name="content">
                <trix-editor input="x"></trix-editor>
                @error('content')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
            @if (isset($post))
            <div class="form-group">
                <img src="{{ asset('storage/' . $post->image) }}" style="width: 100px" height="100px">
            </div>
            @endif
            <div class="form-group" >
                <label for="post image">Image:</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="selectCategory">Select a category</label>
                <select name="categoryID" class="form-control" id="selectCategory">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                </select>
            </div>
            @if (!$tags->count() <= 0 && isset($post))
            <div class="form-group">
                <label for="selectTag">Select a tag</label>
                <select name="tags[]" class="form-control tags" id="selectTag" >
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if ($post->hasTag($tag->id))
                        selected
                    @endif>
                        {{ $tag->name }}
                    </option>
                @endforeach
                </select>
            </div>
            @endif
            <input value="{{ Auth::user()->id }}" 
            type="hidden"
            name="user_id">
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($post) ? "Update" : "Add" }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.tags').select2();
        });
    </script>
@endsection