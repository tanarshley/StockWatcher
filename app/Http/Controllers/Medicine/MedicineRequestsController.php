<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicineRequest;
use App\Models\Employee;
use App\Models\Constituent;
use App\Models\Medicine;
use App\Models\RequestHistory;
use App\Models\ExpiredMedicine;

class MedicineRequestsController extends Controller
{
    public function showMedicineRequests()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Medicine Requests';
        $requestsCounts = MedicineRequest::count();
        $allMedicineRequests = MedicineRequest::paginate(10);
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $allMedicineRequests->sortByDesc('created_at');
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        //get constituent_id from allMedicineRequests
        $allMedicineRequestsConstituentIds = $allMedicineRequests->pluck('constituent_id');
        //get data of constituents from allMedicineRequestsConstituentIds
        $allMedicineRequestsConstituents = Constituent::whereIn('constituent_id', $allMedicineRequestsConstituentIds)->get();
        //get medicine_id from allMedicineRequests
        $allMedicineRequestsMedicineIds = $allMedicineRequests->pluck('medicine_id');
        //get data of medicines from allMedicineRequestsMedicineIds
        $allMedicineRequestsMedicines = Medicine::whereIn('medicine_id', $allMedicineRequestsMedicineIds)->get();

        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $getAllApproved = MedicineRequest::where('request_status', 'Approved')->get();


        return view('employee.medicine-requests', $logged_data, compact('title', 'getAllPending', 'allMedicineRequests', 'allMedicineRequestsConstituents', 'allMedicineRequestsMedicines', 'getAllPending', 'getAllApproved', 'requestsCounts', 'allExpiredMedicinesToday'));
    }

    public function approveMedicineRequest(Request $request, $medicine_request_id)
    {
       //update medicine_requests table
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $medicineRequest = MedicineRequest::find($medicine_request_id);
        $medicineRequest->request_status = 'Approved';
        $medicineRequest->processed_by = $logged_data['LoggedEmployee']->employee_name;

        $save = $medicineRequest->save();

        if($save){
            return redirect()->route('employee.medicine-requests')->with('requestApproved', 'Medicine Request Approved');
        }else{
            return back()->with('requestNotApproved', 'Something went wrong, try again later');
        }
    }

    public function rejectMedicineRequest(Request $request, $medicine_request_id)
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $medicineRequest = MedicineRequest::find($medicine_request_id);
        $medicineRequest->request_status = 'Rejected';
        $medicineRequest->processed_by = $logged_data['LoggedEmployee']->employee_name;
        $saveReject = $medicineRequest->save();

        $medicineRequestHistory = new RequestHistory;
        $medicineRequestHistory->medicine_request_id = $medicine_request_id;
        $medicineRequestHistory->medicine_id = $medicineRequest->medicine_id;
        $medicineRequestHistory->constituent_id = $medicineRequest->constituent_id;
        $medicineRequestHistory->household_id = $medicineRequest->household_id;
        $medicineRequestHistory->quantity_of_request = $medicineRequest->quantity_of_request;
        $medicineRequestHistory->request_status = $medicineRequest->request_status;
        $medicineRequestHistory->processed_by = $medicineRequest->processed_by;

        $saveToHistory = $medicineRequestHistory->save();

        if($saveReject && $saveToHistory){
            $delete = $medicineRequest->delete();
            return redirect()->route('employee.medicine-requests')->with('requestRejected', 'Medicine Request Rejected. Check History for more details');
        }
        else{
            return back()->with('requestNotRejected', 'Something went wrong, try again later');
        }
    }

    public function deliveredMedicineRequest(Request $request, $medicine_request_id)
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $medicineRequest = MedicineRequest::find($medicine_request_id);
        $medicineRequest->request_status = 'Delivered';
        $medicineRequest->processed_by = $logged_data['LoggedEmployee']->employee_name;
        $saveDelivered = $medicineRequest->save();

        $medicineRequestHistory = new RequestHistory;
        $medicineRequestHistory->medicine_request_id = $medicine_request_id;
        $medicineRequestHistory->medicine_id = $medicineRequest->medicine_id;
        $medicineRequestHistory->constituent_id = $medicineRequest->constituent_id;
        $medicineRequestHistory->household_id = $medicineRequest->household_id;
        $medicineRequestHistory->quantity_of_request = $medicineRequest->quantity_of_request;
        $medicineRequestHistory->request_status = $medicineRequest->request_status;
        $medicineRequestHistory->processed_by = $medicineRequest->processed_by;

        $saveToHistory = $medicineRequestHistory->save();

        if($saveDelivered && $saveToHistory){
            $delete = $medicineRequest->delete();
            //update medicine quantity in medicine table
            $medicine = Medicine::where('medicine_id', $medicineRequest->medicine_id)->first();
            $medicine->medicine_quantity = $medicine->medicine_quantity - $medicineRequest->quantity_of_request;
            $medicine->save();
            return redirect()->route('employee.medicine-requests')->with('requestDelivered', 'Medicine Request Delivered. Check History for more details');
        }
        else{
            return back()->with('requestNotDelivered', 'Something went wrong, try again later');
        }
    }
}
