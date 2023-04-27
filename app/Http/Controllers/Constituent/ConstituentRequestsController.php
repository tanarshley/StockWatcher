<?php

namespace App\Http\Controllers\Constituent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constituent;
use App\Models\MedicineRequest;
use App\Models\Medicine;
use App\Models\RequestHistory;

class ConstituentRequestsController extends Controller
{
    public function showRequests()
    {
        $logged_data = ['LoggedConstituent'=>Constituent::where('constituent_id', session('LoggedConstituent'))->first()];
        $title = 'Requests';
        $allRequests = MedicineRequest::where('constituent_id', session('LoggedConstituent'))->get();
        $requestMedicineId = MedicineRequest::where('constituent_id', session('LoggedConstituent'))->pluck('medicine_id');
        $requestMedicineInfo = Medicine::whereIn('medicine_id', $requestMedicineId)->get();
        $requestHistory = RequestHistory::where('constituent_id', session('LoggedConstituent'))->get();

        return view('constituent.requests', $logged_data, compact('title', 'allRequests', 'requestMedicineInfo', 'requestHistory'));
    }
}
