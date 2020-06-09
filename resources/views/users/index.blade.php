@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <div class="pt-2">
                <p>Users</p>
            </div>
            {{-- <div>
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category </a>
            </div> --}}
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img src="{{ Gravatar::src($user->email) }}" class="w-40 rounded-circle" alt="">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!$user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success">Make admin</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center">
                    NO USERS FOUND
                </h1>
            @endif
@endsection

@section('scripts')
    <script>
        function deleteModal(id) {
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection
