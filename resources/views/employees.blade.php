<!-- resources/views/employees/index.blade.php -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<p id="role" style="display: none;"> {{ Auth::user()->role }}</p>
<div class="container mt-5">
<div class="d-flex align-items-center justify-content-between mb-4">
    <h2 class="mb-0">Employees</h2>

    <div class="d-flex align-items-center">
    <form id="myFormGroup" action="/employees/filtergroup" method="GET" class="d-flex align-items-center">
    <select name="group" id="group" class="form-select form-select-sm me-3" style="width: auto;">
        <option value="">All Groups</option>
    @foreach($groups as $group)
        <option value="{{ $group->id }}">
            {{ $group->group_name }}
        </option>
    @endforeach
    </select>
    </form>

    <form id="myForm" action="/employees/filter" method="GET" class="d-flex align-items-center">
    <p class="mb-0 me-3" style="font-size: 15px;">Filter By Active</p>
    <select name="status" id="status" class="form-select form-select-sm me-3" style="width: auto;">
        <option value="" {{ request('status') === 'All' ? 'selected' : '' }}>All</option>
        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
</form>

        <!-- Add Employee Button -->
        <a href="{{ route('addEmp') }}" id="addEmp" class="btn btn-primary btn-sm">Add Employee</a>
    </div>
</div>

    <div class="card mt-4">
        <div class="card-body">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Emp Code</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Start Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->emp_code }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->active }}</td>
                <td>{{ $employee->created_at }}</td>
                <td>
                    <a href="{{ route('view', $employee->id) }}"  class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('editEmp', $employee->id) }}" id="updateBtn" class="btn btn-warning btn-sm">Update</a>
                    <a href="{{ route('deleteEmp', $employee->id) }}" id="deleteBtn" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //Listen for change event on the select element
        $('#status').on('change', function() {
            //Submit the form when selection changes
            var optionSelected = $('option:selected', this);
            var selectedValue = optionSelected.val();

            $('#myForm').submit();
            $('#myForm'.on('submit'), function() {
            $('#status').val(selectedValue);
            });

        });
    });

    $(document).ready(function () {
        //Listen for change event on the select element
        $('#group').on('change', function() {
            //Submit the form when selection changes
            var optionSelected = $('option:selected', this);
            var selectedValue = optionSelected.val();

            $('#myFormGroup').submit();
            $('#myFormGroup'.on('submit'), function() {
            $('#group').val(selectedValue);
            });

        });
    });
    //Manipulate CRUD operations based on user role
    document.addEventListener('DOMContentLoaded', function () {
    var addEmp = document.getElementById('addEmp');
    var getRoleElement = document.getElementById('role');
    var deleteEmp = document.querySelectorAll('[id="deleteBtn"]');
    var updateBtn = document.querySelectorAll('[id="updateBtn"]');

    // Check if the elements exist
    if (getRoleElement) {
        var getRole = getRoleElement.innerText.trim(); // Get role and remove extra spaces

        // Hide the button if the role is 'Admin'
        if(getRole === 'Update') {
            addEmp.style.display = 'none';

            //Loop all occurences of a delete button
            deleteEmp.forEach(element => {
                element.style.display = 'none';
            });
        }
        else if(getRole === 'View') {
            addEmp.style.display = 'none';

            //Loop through each delete and update buttons to hide
            deleteEmp.forEach(element => {
                element.style.display = 'none';
            });
            updateBtn.forEach(element => {
                element.style.display = 'none';
            });
        }
    }
    else {
        console.error('Element not found: Ensure that elements with IDs "addEmp" and "role" exist.');
    }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
