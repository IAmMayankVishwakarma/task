@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
<div class="card">
    <div class="card-header">Edit Department</div>
    <div class="card-body">
        <form action="{{ route('web-departments.update', ['web_department' => $department->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ $department->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $department->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection