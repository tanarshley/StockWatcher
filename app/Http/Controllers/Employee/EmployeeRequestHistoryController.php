<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\MedicineRequest;
use App\Models\Medicine;
use App\Models\RequestHistory;
use App\Models\Constituent;
use App\Models\ExpiredMedicine;

class EmployeeRequestHistoryController extends Controller
{
    public function showRequestHistory()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Request History';
        $requestHistoryCounts = RequestHistory::count();
        $requestHistory = RequestHistory::paginate(10);
        $requestHistory->sortByDesc('created_at')->all();
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $requestHistoryMedicineIds = $requestHistory->pluck('medicine_id');
        $requestHistoryMedicines = Medicine::whereIn('medicine_id', $requestHistoryMedicineIds)->get();

        $getAllRejected = RequestHistory::where('request_status', 'Rejected')->get();
        $getAllDelivered = RequestHistory::where('request_status', 'Delivered')->get();

        $requestHistoryConstituentIds = $requestHistory->pluck('constituent_id');
        $requestHistoryConstituents = Constituent::whereIn('constituent_id', $requestHistoryConstituentIds)->get();
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();

        return view('employee.requests-history', $logged_data, compact('title', 'getAllPending', 'requestHistory', 'requestHistoryMedicines', 'requestHistoryConstituents', 'getAllRejected', 'getAllDelivered', 'requestHistoryCounts', 'allExpiredMedicinesToday'));
    }

    public function deleteHistory($request_history_id)
    {
        $requestHistory = RequestHistory::find($request_history_id);
        $deleted = $requestHistory->delete();

        if($deleted)
        {
            return redirect()->route('employee.requests-history')->with('historyDeleted', 'Request history deleted successfully');
        }
        else
        {
            return back()->with('historyNotDeleted', 'Something went wrong, please try again');
        }
    }

    //create a function that will delete a request history after 5 days based on the date of update_at and activate it in the kernel.php
    public function deleteHistoryAfter5Days()
    {
        $autoDeleteRequestHistory = RequestHistory::all();
        $autoDeleteRequestHistory->each(function($autoDeleteRequestHistory){
            if($autoDeleteRequestHistory->updated_at->diffInDays() > 5)
            {
                $autoDeleteRequestHistory->delete();
            }
        });
    }
}
