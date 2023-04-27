<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constituent;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;

class ConstituentsListController extends Controller
{
    public function showConstituentLists()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Constituents List';
        $allConstituentsCount = Constituent::count();
        $allConstituents = Constituent::paginate(10);
        $allConstituents->sortByDesc('created_at');
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();

        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();

        return view('employee.constituents-list', $logged_data, compact('title', 'getAllPending', 'allConstituents', 'allConstituentsCount', 'allExpiredMedicinesToday'));
    }

    public function addConstituent(Request $request)
    {
        $request->validate([
            'household_id' => 'required|unique:constituents',
            'constituent_firstName' => 'required',
            'constituent_middleName' => 'required',
            'constituent_lastName' => 'required',
            'constituent_email' => 'required|email|unique:constituents',
            'constituent_address' => 'required',
            'constituent_birthdate' => 'required',
            'constituent_phone' => 'required|digits:11|unique:constituents',
        ]);
        
        $constituent = new Constituent;
        $constituent->household_id = $request->household_id;
        $constituent->constituent_name = ucwords($request->constituent_firstName . ' ' . $request->constituent_middleName . ' ' . $request->constituent_lastName);
        $constituent->constituent_email = $request->constituent_email;
        $constituent->constituent_address = $request->constituent_address;
        $constituent->constituent_birthdate = $request->constituent_birthdate;
        $constituent->constituent_phone = $request->constituent_phone;
        $password = $request->constituent_lastName . '' . $request->household_id;
        $constituent->constituent_password = Hash::make($password);

        $save = $constituent->save();

        if ($save) {
            return redirect()->route('employee.constituents-list')->with('constituentAdded', 'New Constituent has been successfully added.');
        } 
        else {
            return back()->with('constituentNotAdded', 'Something went wrong, try again later');
        }
    }

    public function deleteConstituent($constituent_id)
    {
        $constituent = Constituent::find($constituent_id);
        $deleted = $constituent->delete();

        if($deleted)
        {
            return redirect()->route('employee.constituents-list')->with('constituentDeleted', 'Constituent deleted successfully');
        }
        else
        {
            return redirect()->route('employee.constituents-list')->with('constituentNotDeleted', 'Something went wrong, please try again');
        }
    }
}
