@extends('layouts.app')

@section('title', 'Departments')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Departments</h2>
    <a href="{{ route('web-departments.create') }}" class="btn btn-primary">Add Department</a>
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
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>
                <span class="badge bg-{{ $department->status == 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($department->status) }}
                </span>
            </td>
            <td>
                <a href="{{ route('web-departments.edit', $department->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form id="delete-form-{{ $department->id }}" action="{{ route('web-departments.destroy', $department->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('web-departments.destroy', $department->id) }}"
                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $department->id }}').submit();"
                        class="btn btn-sm btn-danger">
                         Delete
                     </a>
                     
                </form>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection