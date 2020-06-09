@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <div class="pt-2">
                <p>Posts</p>
            </div>
            <div>
                <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post </a>
            </div>
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ asset('/storage/'.$post->image) }}" style="width: 60px; height: 60px;" alt="image">
                                </td>
                                <td class="pt-4">
                                    {{ $post->title }}
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $post->category->id) }}">
                                        {{ $post->category->name }}
                                    </a>
                                </td>
                                <td class="pt-4 d-flex">
                                    @if (!$post->trashed())
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info text-white mr-2">Edit</a>
                                    @else
                                        <form action="{{ route('restore-post', $post->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm text-white mr-2">Restore</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center">
                    NO POSTS YET
                </h1>
            @endif
        </div>
    </div>
@endsection
