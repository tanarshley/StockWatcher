<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;

class EmployeeEmployeesController extends Controller
{
    public function showEmployees()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        //prevent user from accessing this page if their role is not 'Admin'
        if($logged_data['LoggedEmployee']->employee_role != 'Admin')
        {
            return redirect('employee/dashboard');
        }
        else
        {
            $overallAllEmployees = Employee::all();
            $allAdmins = Employee::where('employee_role', 'Admin')->get();
            $allEmployees = Employee::where('employee_role', 'Employee')->get();
            $title = 'Employees';
            $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
            $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();

            return view('employee.employees', compact('overallAllEmployees', 'getAllPending', 'allAdmins', 'allEmployees', 'title', 'allExpiredMedicinesToday'))->with($logged_data);
        }
    }

    public function deleteEmployee($employee_id)
    {
        $deleteEmployee = Employee::where('employee_id', $employee_id)->delete();
        if($deleteEmployee)
        {
            return back()->with('employeeDeleted', 'Employee deleted successfully');
        }
        else
        {
            return back()->with('employeeNotDeleted', 'Something went wrong, please try again');
        }
    }
}
