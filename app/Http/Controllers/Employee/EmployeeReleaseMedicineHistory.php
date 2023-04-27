<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReleaseHistory;
use App\Models\Employee;
use App\Models\Medicine;
use App\Models\Constituent;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;

class EmployeeReleaseMedicineHistory extends Controller
{
    public function showReleaseMedicineHistory()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Release Medicines History';
        $allReleaseMedicineHistory = ReleaseHistory::paginate(10);
        //get medicine information from medicine_id
        $medicine_id = $allReleaseMedicineHistory->pluck('medicine_id');
        $medicineInfo = Medicine::whereIn('medicine_id', $medicine_id)->get();
        //get employee information from employee_id
        $employee_id = $allReleaseMedicineHistory->pluck('employee_id');
        $employeeInfo = Employee::whereIn('employee_id', $employee_id)->get();

        $allReleaseMedicineHistory->sortByDesc('created_at');
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        return view('employee.release-history', $logged_data, compact('title', 'allReleaseMedicineHistory' ,'getAllPending', 'allExpiredMedicinesToday', 'medicineInfo', 'employeeInfo'));
    }
}
