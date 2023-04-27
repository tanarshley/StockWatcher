<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;

class EmployeeAccountInformationController extends Controller
{
    public function showAccountInformation()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Account Information';
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        
        return view('employee.account-information', $logged_data, compact('title', 'getAllPending', 'allExpiredMedicinesToday'));
    }

    public function editAccountInformation(Request $request, $employee_id)
    {
        $request->validate([
            'employee_name' => 'required|unique:employees,employee_name,'.$employee_id.',employee_id',
            'employee_email' => 'required|email|unique:employees,employee_email,'.$employee_id.',employee_id',
            'employee_phone' => 'required|digits:11|unique:employees,employee_phone,'.$employee_id.',employee_id',
            'employee_username' => 'required|unique:employees,employee_username,'.$employee_id.',employee_id',
            'employee_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = Employee::find($employee_id);
        $employee->employee_name = ucwords($request->employee_name);
        $employee->employee_email = $request->employee_email;
        $employee->employee_phone = $request->employee_phone;
        $employee->employee_username = $request->employee_username;
        if($request->employee_picture)
        {
            $employee_picture = $request->file('employee_picture');
            $employee_picture_name = time().'.'.$employee_picture->getClientOriginalExtension();
            $employee_picture->move(public_path('uploads/employee'), $employee_picture_name);
            $employee->employee_picture = $employee_picture_name;
        }
        $save = $employee->save();

        if($save)
        {
            return back()->with('employeeUpdated', 'Profile Information updated successfully');
        }
        else
        {
            return back()->with('employeeNotUpdated', 'Something went wrong, please try again');
        }
    }

    public function editAccountPassword(Request $request, $employee_id)
    {
        $request->validate([
            'employee_password' => 'required',
            'new_password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $employee = Employee::find($employee_id);
        $current_password = $employee->employee_password;
        if(Hash::check($request->employee_password, $current_password))
        {
            $employee->employee_password = Hash::make($request->new_password);
            $save = $employee->save();

            if($save)
            {
                return back()->with('employeePasswordUpdated', 'Password updated successfully');
            }
            else
            {
                return back()->with('employeePasswordNotUpdated', 'Something went wrong, please try again');
            }
        }
        else
        {
            return back()->with('employeeIncorrectCurrentPassword', 'Current password is incorrect');
        }
    }
}
