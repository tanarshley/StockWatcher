<?php

namespace App\Http\Controllers\Constituent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constituent;
use App\Models\MedicineRequest;
use App\Models\Medicine;
use App\Models\RequestHistory;

class ConstituentMedicineRequestController extends Controller
{
    public function showRequestMedicine()
    {
        $logged_data = ['LoggedConstituent'=>Constituent::where('constituent_id', session('LoggedConstituent'))->first()];
        $title = 'Medicine Request';
        //get all medicines that are available for request (request_availability = 'Yes) and medicine_date_of_expiry is not less than or equal to 7 days from today
        $allMedicines = Medicine::where('request_availability', 'Yes')->where('medicine_date_of_expiry', '>', date('Y-m-d', strtotime('+7 days')))->get();

        return view('constituent.request-medicine', $logged_data, compact('title', 'allMedicines'));
    }

    public function requestMedicine(Request $request, $constituent_id)
    {
        $request->validate([
            'medicine_id' => 'required',
            'household_id' => 'required',
            'quantity_of_request' => 'required',
        ]);

        $requestLimit = Constituent::where('constituent_id', $constituent_id)->first();

        if($requestLimit->request_limit == 0){
            return back()->with('requestLimitExceeded', 'Request Limit Exceeded! Request limit is 2 requests per day.');
        }
        else{
            $requestLimit->request_limit = $requestLimit->request_limit - 1;
            $requestLimit->save();

            $medicineRequest = new MedicineRequest;
            $medicineRequest->medicine_id = $request->medicine_id;
            $medicineRequest->constituent_id = $constituent_id;
            $medicineRequest->household_id = $request->household_id;
            $medicineRequest->quantity_of_request = $request->quantity_of_request;
            $medicineRequest->request_status = 'Pending';
    
            $save = $medicineRequest->save();
    
            if($save){
                return back()->with('medicineRequested', 'Medicine Requested Successfully! Please wait for the approval.');
            }
            else{
                return back()->with('medicineNotRequested', 'Medicine Request Failed!. Please try again.');
            }
        }
    }

    public function cancelMedicineRequest($medicine_request_id)
    {
        $deleteMedicineRequest = MedicineRequest::find($medicine_request_id);
        $delete = $deleteMedicineRequest->delete();

        if($delete){
            return back()->with('medicineRequestCancelled', 'You cancelled your medicine request.');
        }
        else{
            return back()->with('medicineRequestNotCancelled', 'Medicine Request Cancel Failed!. Please try again.');
        }
    }

    public function showRequestHistory()
    {
        $logged_data = ['LoggedConstituent'=>Constituent::where('constituent_id', session('LoggedConstituent'))->first()];
        $title = 'Requests History';
        $requestHistory = RequestHistory::where('constituent_id', session('LoggedConstituent'))->get()->sortByDesc('updated_at');
        $requestMedicineId = RequestHistory::where('constituent_id', session('LoggedConstituent'))->pluck('medicine_id');
        $requestMedicineInfo = Medicine::whereIn('medicine_id', $requestMedicineId)->get();

        return view('constituent.requests-history', $logged_data, compact('title', 'requestHistory', 'requestMedicineInfo'));
    }
}
