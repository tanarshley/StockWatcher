<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpiredMedicine;
use App\Models\Employee;
use App\Models\MedicineRequest;

class ExpiredMedicinesController extends Controller
{
    public function showExpiredMedicines()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Expired Medicines';
        $allExpiredCountsMedicines = ExpiredMedicine::count();
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        $allExpiredMedicines = ExpiredMedicine::paginate(10);
        $allExpiredMedicines->sortByDesc('created_at');
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        
        return view('employee.expired-medicines', $logged_data, compact('title', 'getAllPending', 'allExpiredMedicines', 'allExpiredCountsMedicines', 'allExpiredMedicinesToday'));
    }

    public function deleteExpiredMedicine($expired_medicine_id)
    {
        $delete = ExpiredMedicine::where('expired_medicine_id', $expired_medicine_id)->delete();

        if($delete)
        {
            return redirect()->route('employee.expired-medicines')->with('expiredMedicineDeleted', 'Medicine has been deleted successfully!');
        }
        else
        {
            return redirect()->route('employee.expired-medicines')->with('expiredMedicineNotDeleted', 'Something went wrong, try again later!');
        }
    }
}
