<!-- resources/views/employees/create.blade.php -->

@extends('layouts.app') <!-- Assuming you have a base layout called 'app' -->

@section('content')
<a href="{{ url('/employees') }}" class="btn btn-secondary">Back</a>
<br>
<div class="container mt-5">
    <h2>Add Employee</h2>
    <form action="{{ route('addEmp') }}" method="POST">
        @csrf  <!-- Laravel CSRF token for security -->

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label for="emp_code" class="form-label">Employee Code</label>
            <input type="text" class="form-control" id="emp_code" name="emp_code" placeholder="Enter employee code" required>
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
            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date">
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" step="0.01" class="form-control" id="salary" name="salary" placeholder="Enter salary" required>
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

