@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ isset($user) ? 'Update User' : 'Add New User' }}</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ isset($user) ? '/users/update/' . $user->id : '/users/create' }}">
                        @csrf
                        @if(isset($user))
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" placeholder="Enter name" required>
                        </div>
                        @error('name')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" placeholder="Enter email" required>
                        </div>
                        @error('email')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter password' }}" {{ isset($user) ? '' : 'required' }}>
                        </div>
                        @error('password')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update User' : 'Create User' }}</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Existing Users</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $userItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userItem->name }}</td>
                                        <td>{{ $userItem->email }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($userItem->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="/users/edit/{{ $userItem->id }}" class="btn btn-sm btn-secondary me-2">Edit</a>
                                            <form method="POST" action="/users/delete/{{ $userItem->id }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No users found. Add your first user above.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
