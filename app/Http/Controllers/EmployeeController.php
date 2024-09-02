<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function employees()
    {
        $groups = EmployeeGroup::all();
        $employees = Employee::all();
        return view('employees', compact('employees', 'groups'));
    }

    public function employeeInformation($employeeId)
    {
        $employee = Employee::with('groups')->findOrFail($employeeId);
        return view('view', compact('employee'));
    }

    public function addEmployee()
    {
        if(Auth::user()->role === 'Admin')
        {
            $groups = EmployeeGroup::all();
            return view('addEmp', compact('groups'));
        }

        // Redirect or show an error message if not an admin
        return redirect('/employees')->with('error', 'Unauthorized access');

    }

    public function edit($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $groups = EmployeeGroup::all();

        //Check if user is admin or update role
        if(Auth::user()->role === 'Admin' || Auth::user()->role === "Update")
        {
            return view('updateEmp', compact(['employee', 'groups']));
        }

        return redirect('/employees')->with('Error', 'unauthorized user');
    }

    public function destroy($employeeId)
    {
        if(Auth::user()->role === 'Admin')
        {
            $employee = Employee::findOrFail($employeeId);
            $employee->delete();
            return redirect('/employees')->with('Success', 'employee deleted');
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email', // Assuming email must be unique
            'emp_code' => 'required|string|max:50',
            'active' => 'required|boolean',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string',
            'start_date' => 'nullable|date',
            'salary' => 'required|numeric|min:0',
            'groups' => 'nullable|array',
            'groups.*' => 'exists:employee_groups,id',
        ]);

        // Create a new employee record
        $employee = Employee::create($request->all());

        if ($request->has('groups')) {
            $employee->groups()->attach($request->groups);
        }

        // Redirect back with success message
        return redirect()->route('addEmp')->with('success', 'Employee added successfully');
    }

    public function updateEmployee(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        if(Auth::user()->role === 'Admin' || Auth::user()->role === 'Update')

        {
            //Valid the request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'emp_code' => 'required|string|max:50',
                'active' => 'required|boolean',
                'contact_number' => 'required|string|max:15',
                'address' => 'required|string',
                'start_date' => 'nullable|date',
                'salary' => 'required|numeric|min:0',
                'group_id' => 'nullable|exists:groups,id',
                'groups' => 'nullable|array',
                'groups.*' => 'exists:employee_groups,id',
            ]);

            $employee->update($validatedData);

            return redirect('/employees')->with('Success', 'employee information updated successfully');

        }

        return redirect('/employees')->with('error', 'Unothorized to update information');
    }


        public function filterEmpByActive(Request $request)
        {
            // Retrieve the filter value from the request
            $groups = EmployeeGroup::all();
            $status = $request->input('status');

            $fieldName = 'active';

            if($status === '0' || $status === '1')
            {
                $employees = Employee::where($fieldName, $status)->get();

                // Pass the filtered employees data to the view
                return view('employees', compact('employees', 'groups'));
            }
            else
            {
                $employees = Employee::all();
                return view('employees', compact('employees', 'groups'));
            }



        }

        public function filterByGroup(Request $request)
        {

            $groupId = $request->input('group');
            // Retrieve the filter value from the request
            $groups = EmployeeGroup::all();

            // Filter employees by the selected group
            $employees = Employee::whereHas('groups', function ($query) use ($groupId) {
            $query->where('employee_group_id', $groupId);
            })->get();

            return view('employees', compact('employees', 'groups', 'groupId'));


        }
    }





