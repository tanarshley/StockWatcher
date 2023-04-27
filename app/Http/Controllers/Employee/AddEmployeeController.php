<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class AddEmployeeController extends Controller
{
    public function addEmployee(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|unique:employees',
            'employee_email' => 'required|email|unique:employees',
            'employee_phone' => 'required|digits:11|unique:employees',
            'employee_username' => 'required|unique:employees',
            'employee_password' => 'required',
            'employee_confirm_password' => 'required|same:employee_password',
            'employee_role' => 'required',
        ]);
        
        $employee = new Employee;
        $employee->employee_name = ucwords($request->employee_name);
        $employee->employee_email = $request->employee_email;
        $employee->employee_phone = $request->employee_phone;
        $employee->employee_username = $request->employee_username;
        $employee->employee_password = Hash::make($request->employee_password);
        $employee->employee_role = $request->employee_role;
        $save = $employee->save();

        if($save)
        {
            return back()->with('employeeAdded', 'Employee added successfully');
        }
        else
        {
            return back()->with('employeeNotAdded', 'Something went wrong, please try again');
        }
    }
}
