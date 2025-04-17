@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Employees</h2>
    <div>
        <a href="{{ route('web-employees.create') }}" class="btn btn-primary">Add Employee</a>
        {{-- <a href="{{ route('web-employees.export') }}" class="btn btn-success disabled">Export to Excel</a> --}}
    </div>
</div>
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>
                @if($employee->profile_photo)
                <img src="{{ asset('storage/'.$employee->profile_photo) }}" width="50" height="50" class="rounded-circle">
                @else
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    {{ substr($employee->name, 0, 1) }}
                </div>
                @endif
            </td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->department->name }}</td>
            <td>
                <a href="{{ route('web-employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('web-employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection