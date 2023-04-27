<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;
use App\Models\Employee;
use App\Models\Constituent;
use App\Models\ReleaseHistory;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Dashboard';
        $allMedicines = Medicine::all();
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $allExpiredMedicines = ExpiredMedicine::all();
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        $allMedicineRequests = MedicineRequest::all();
        $UpcomingExpiringMedicines = Medicine::where('medicine_date_of_expiry', '<=', date('Y-m-d', strtotime('+7 days')))->get();
        $latestMedicineRequests = MedicineRequest::latest()->take(5)->get();
        //pluck constituent_id from latestMedicineRequests
        $latestMedicineRequestsConstituentIds = $latestMedicineRequests->pluck('constituent_id');
        //get data of constituents from latestMedicineRequestsConstituentIds
        $latestMedicineRequestsConstituents = Constituent::whereIn('constituent_id', $latestMedicineRequestsConstituentIds)->get();
        //pluck medicine_id from latestMedicineRequests
        $latestMedicineRequestsMedicineIds = $latestMedicineRequests->pluck('medicine_id');
        //get data of medicines from latestMedicineRequestsMedicineIds
        $latestMedicineRequestsMedicines = Medicine::whereIn('medicine_id', $latestMedicineRequestsMedicineIds)->get();
        $totalReleasedMedicines = ReleaseHistory::all();        

        return view('employee.dashboard', $logged_data, compact('title', 'allMedicines', 'getAllPending', 'allExpiredMedicines', 'totalReleasedMedicines',
        'allMedicineRequests', 'UpcomingExpiringMedicines', 'latestMedicineRequests', 'latestMedicineRequestsConstituents', 'latestMedicineRequestsMedicines', 'allExpiredMedicinesToday'));
    }
}
