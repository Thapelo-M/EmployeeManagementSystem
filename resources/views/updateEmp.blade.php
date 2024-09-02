@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Employee Details</h2>

    {{-- Show any success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $employee->surname) }}" required>
            @error('surname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="emp_code" class="form-label">Employee Code</label>
            <input type="text" class="form-control @error('Emp code') is-invalid @enderror" id="emp_code" name="emp_code" value="{{ old('emp_code', $employee->emp_code) }}" required>
            @error('emp_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Active Status</label>
            <select class="form-select" id="active" name="active">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number', $employee->contact_number) }}" required>
            @error('emp_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label"><Address></Address></label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address" required>{{ old('address', $employee->address) }}</textarea>

            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Employee Code</label>
            <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}" required>
            @error('emp_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div>
                @foreach($groups as $group)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="group{{ $group->id }}" name="groups[]" value="{{ $group->id }}">
                        <label class="form-check-label" for="group{{ $group->id }}">
                            {{ $group->group_name }}
                        </label>
                    </div>
                @endforeach
        </div>

        {{-- Add more fields as needed --}}

        <button type="submit" class="btn btn-primary">Update Employee</button>
        <a href="{{ url('/employees') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
