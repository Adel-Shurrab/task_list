@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ isset($task) ? 'Update Task' : 'Task List' }}</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ isset($task) ? '/update' : '/create' }}">
                        @csrf
                        @if(isset($task))
                            <input type="hidden" name="id" value="{{ $task->id }}">
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Task Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $task->name ?? '') }}" placeholder="Enter a task" required>
                        </div>
                        @error('name')
                            <div class="text-danger mb-3">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Update' : 'Add Task' }}</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Existing Tasks</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($task->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="/edit/{{ $task->id }}" class="btn btn-sm btn-secondary me-2">Edit</a>
                                            <form method="POST" action="/delete/{{ $task->id }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">No tasks yet. Add your first task above.</td>
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
