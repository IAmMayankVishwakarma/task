@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Departments</h5>
                    <p class="card-text display-4">{{ $totalDepartments }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Employees</h5>
                    <p class="card-text display-4">{{ $totalEmployees }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <h2>Recent Employees</h2>
    <div class="row">
        @foreach($recentEmployees as $employee)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($employee->profile_photo)
                <img src="{{ asset('storage/'.$employee->profile_photo) }}" class="card-img-top" alt="{{ $employee->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $employee->name }}</h5>
                    <p class="card-text">{{ $employee->department->name }}</p>
                    <p class="card-text">{{ $employee->email }}</p>
                    <a href="{{ route('web-employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection