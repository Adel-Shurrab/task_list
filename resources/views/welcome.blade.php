@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Welcome to Task Manager</h1>
            <p class="lead mb-4">A simple and effective task management application built with Laravel.</p>
            
            <div class="list-group">
                <a href="{{ url('/tasks') }}" class="list-group-item list-group-item-action">
                    <strong>Manage Tasks</strong>
                </a>
                <a href="{{ url('/form') }}" class="list-group-item list-group-item-action">
                    <strong>Form Demo</strong>
                </a>
                <a href="{{ url('/about') }}" class="list-group-item list-group-item-action">
                    <strong>About</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
