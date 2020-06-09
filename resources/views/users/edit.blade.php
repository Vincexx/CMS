@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $user->name }}'s Profile</div>

        <div class="card-body">
            @include('alerts.error')
            <form action="{{ route('users.update-profile') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name"></label>
                    <input type="text" placeholder="Enter name" id="name" name="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="about"></label>
                    <textarea name="about" id="about" cols="5" rows="5" class="form-control" placeholder="Tell something about yourself ...">{{ $user->about }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection
