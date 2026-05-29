@extends('layouts.app')

@section('title', 'About Page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">About Page</h1>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <p class="mb-0"><strong>Welcome, {{ $name }}!</strong></p>
                        <p>This is the about page where we display data passed from the route to the view.</p>
                    </div>

                    <p>The variable <code>${{ 'name' }}</code> displays the value: <strong>{{ $name }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection