<!-- resources/views/employees/show.blade.php -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        ul
        {
            list-style: none;
        }
        li
        {
            list-style:square;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Employee Details</h2>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"> <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }} + {{ urlencode($employee->surname) }}&background=random" /> {{ $employee->name }}  {{ $employee->surname }}</h5>
            <p class="card-text"> <i class="fa fa-envelope"></i> <strong>Email:</strong> {{ $employee->email }}</p>
            <p class="card-text"> <i class="fa fa-calendar"></i>  <strong>Start Date</strong> {{ $employee->start_date}}</p>
            <p class="card-text"> <i class="fa fa-money"></i>  <strong>Salary</strong> {{ $employee->salary}}</p>
            <p class="card-text"> <i class="fa fa-phone"></i> <strong>Contact Number:</strong> {{ $employee->contact_number }} </p>
            <p class="card-text"> <i class="fa fa-address-card-o"></i> <strong>Address:</strong> {{ $employee->address }} </p>
            <p class="card-text"><strong>Groups:</p>
            <ul>
                @foreach ($employee->groups as $group)
                <li>{{ $group->group_name }}</li>
                @endforeach
            </ul>

            <a href="{{ url('/employees') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
