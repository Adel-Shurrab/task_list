@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ isset($submitted) && $submitted ? 'Form Submission Confirmation' : 'Submit Your Information' }}</h2>
                </div>

                <div class="card-body">
                    @if(isset($submitted) && $submitted)
                        <div class="alert alert-success" role="alert">
                            <strong>Form submitted successfully!</strong>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Submitted Name:</strong></label>
                            <p class="form-control-static">{{ $name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Selected Department:</strong></label>
                            <p class="form-control-static">{{ $departmentName }}</p>
                        </div>

                        <hr>
                    @endif

                    <form action="{{ route('form.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                placeholder="Enter your name"
                                value="{{ old('name', $name ?? '') }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select 
                                class="form-select @error('department') is-invalid @enderror" 
                                id="department" 
                                name="department"
                                required
                            >
                                <option value="">-- Select a Department --</option>
                                @foreach($departments as $id => $name)
                                    <option value="{{ $id }}" {{ old('department') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
