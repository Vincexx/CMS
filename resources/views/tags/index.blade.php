@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <div class="pt-2">
                <p>Tags</p>
            </div>
            <div>
                <a href="{{ route('tags.create') }}" class="btn btn-success">Add Tag </a>
            </div>
        </div>
        <div class="card-body">
            @if ($tags->count() > 0)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th># of Posts</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td> {{ $tag->posts->count() }} </td>
                                <td>
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <button class="btn btn-sm btn-danger text-white" onclick="deleteModal({{ $tag->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center">
                    NO TAGS FOUND
                </h1>
            @endif

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="POST" id="deleteTagForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Tag?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteModal(id) {
            var form = document.getElementById('deleteTagForm');
            form.action = '/tags/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection
