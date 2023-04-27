<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;

class EmployeeLoginController extends Controller
{
    public function showLogin()
    {
        $title = 'StockWatcher';
        return view('employee.login', ['title' => $title]);
    }

    public function loginEmployee(Request $request)
    {
        $request->validate([
            'employee_username' => 'required',
            'employee_password' => 'required',
        ]);

        $employee = Employee::where('employee_username','=', $request->employee_username)->first();

        if(!$employee)
        {
            return back()->with('notFound', 'Account not found, please try again');
        }
        else{
            if(Hash::check($request->employee_password, $employee->employee_password))
            {
                $request->session()->put('LoggedEmployee', $employee->employee_id);
                return redirect()->route('employee.dashboard')->with('loginSuccess', 'Successfully logged in');
            }
            else
            {
                return redirect()->route('employee.login')->with('loginIncorrect', 'Incorrect password.');
            }
        }
    }
}
