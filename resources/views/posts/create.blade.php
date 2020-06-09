@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div>
                <p>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</p>
            </div>
        </div>

        <div class="card-body">
            @include('alerts.error')
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Enter title" id="title"  value="{{ isset($post) ? $post->title : '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control" placeholder="Enter description">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="hidden" id="content" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ asset('/storage/'.$post->image) }}" class="w-100" alt="">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" value="{{ isset($post) ? $post->image : '' }}" id="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category"></label>
                    <select name="category" id="category" class="form-control">
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"

                                @if (isset($post))
                                    @if ($category->id === $post->category_id)
                                        selected
                                    @endif
                                @endif

                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags"></label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            <option value="" disabled>Select Tag</option>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if (isset($post))
                                        @if ($post->hasTags($tag->id))
                                            selected
                                        @endif
                                    @endif
                                >{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif


                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        {{ isset($post) ? 'Update Post' : 'Create Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>

@endsection

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection


