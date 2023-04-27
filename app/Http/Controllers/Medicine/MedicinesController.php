<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Employee;
use App\Models\ExpiredMedicine;
use App\Models\MedicineRequest;
use App\Models\ReleaseHistory;

class MedicinesController extends Controller
{
    public function showMedicines()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Medicines';
        $allMedicineCounts = Medicine::count();
        $allMedicines = Medicine::paginate(10);
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $UpcomingExpiringMedicines = Medicine::where('medicine_date_of_expiry', '<=', date('Y-m-d', strtotime('+7 days')))->get();
        //$allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        //get all expired medicines today that match the current date and medicine_date_of_expiry in the medicine table
        $allExpiredMedicinesToday = Medicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        $expiredToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
        //print in the console if there is an expired medicine today
        if($allExpiredMedicinesToday)
        {
            foreach($allExpiredMedicinesToday as $expiredMedicineToday)
            {
                $expiredMedicine = new ExpiredMedicine;
                $expiredMedicine->medicine_id = $expiredMedicineToday->medicine_id;
                $expiredMedicine->medicine_name = $expiredMedicineToday->medicine_name;
                $expiredMedicine->medicine_brand = $expiredMedicineToday->medicine_brand;
                $expiredMedicine->medicine_category = $expiredMedicineToday->medicine_category;
                $expiredMedicine->medicine_quantity = $expiredMedicineToday->medicine_quantity;
                $expiredMedicine->medicine_no_of_milligrams = $expiredMedicineToday->medicine_no_of_milligrams;
                $expiredMedicine->medicine_measurement = $expiredMedicineToday->medicine_measurement;
                $expiredMedicine->medicine_lot_number = $expiredMedicineToday->medicine_lot_number;
                $expiredMedicine->medicine_date_of_manufacture = $expiredMedicineToday->medicine_date_of_manufacture;
                $expiredMedicine->medicine_date_of_expiry = $expiredMedicineToday->medicine_date_of_expiry;
                $expiredMedicine->medicine_description = $expiredMedicineToday->medicine_description;
                $expiredMedicine->medicine_picture = $expiredMedicineToday->medicine_picture;
                $expiredMedicine->request_availability = $expiredMedicineToday->request_availability;
                $expiredMedicine->save();

                $expiredMedicineToday->delete();
            }
        }
        else
        {
            echo "There is no expired medicine today!";
        }
        
        return view('employee.medicines', $logged_data, compact('title', 'allMedicines', 'getAllPending', 'UpcomingExpiringMedicines', 'allMedicineCounts', 'allExpiredMedicinesToday', 'expiredToday'));
    }

    public function releaseMedicine(Request $request, $medicine_id)
    {
        $request->validate([
            'medicine_id' => 'required',
            'employee_id' => 'required',
            'release_quantity' => 'required',
        ]);

        $medicine = Medicine::where('medicine_id', $medicine_id)->first();
        $medicine->medicine_quantity = $medicine->medicine_quantity - $request->release_quantity;
        $released = $medicine->save();

        $releaseHistory = new ReleaseHistory;
        $releaseHistory->medicine_id = $medicine_id;
        $releaseHistory->employee_id = $request->employee_id;
        $releaseHistory->release_quantity = $request->release_quantity;
        $releaseSuccess = $releaseHistory->save();

        if($released && $releaseSuccess)
        {
            return redirect()->route('employee.medicines')->with('medicineReleased', 'Medicine has been released successfully!');
        }
        else
        {
            return redirect()->route('employee.medicines')->with('medicineNotReleased', 'Something went wrong, try again later!');
        }
    }

    public function addMedicine(Request $request)
    {
        $request->validate([
            'medicine_name' => 'required',
            'medicine_brand' => 'required',
            'medicine_category' => 'required',
            'medicine_quantity' => 'required',
            'medicine_no_of_milligrams' => 'required',
            'medicine_measurement' => 'required',
            'medicine_lot_number' => 'required',
            'medicine_date_of_manufacture' => 'required',
            'medicine_date_of_expiry' => 'required',
            'medicine_description' => 'required',
            'request_availability' => 'required',
        ]);

        $medicine = new Medicine;
        $medicine->medicine_name = $request->medicine_name;
        $medicine->medicine_brand = $request->medicine_brand;
        $medicine->medicine_category = $request->medicine_category;
        $medicine->medicine_quantity = $request->medicine_quantity;
        $medicine->medicine_no_of_milligrams = $request->medicine_no_of_milligrams;
        $medicine->medicine_measurement = $request->medicine_measurement;
        $medicine->medicine_lot_number = $request->medicine_lot_number;
        $medicine->medicine_date_of_manufacture = $request->medicine_date_of_manufacture;
        $medicine->medicine_description = $request->medicine_description;
        $medicine->request_availability = $request->request_availability;

        if($request->medicine_date_of_expiry <= date('Y-m-d'))
        {
            return back()->with('medicineNotAdded', 'Date of expiry must be greater than today!');
        }
        else
        {
            $medicine->medicine_date_of_expiry = $request->medicine_date_of_expiry;
            $save = $medicine->save();

            if($save)
            {
                return back()->with('medicineAdded', 'Medicine has been added successfully!');
            }
            else
            {
                return back()->with('medicineNotAdded', 'Something went wrong, try again later!');
            }
        }
    }

    public function editMedicine(Request $request, $medicine_id)
    {
        $request->validate([
            'medicine_name' => 'required',
            'medicine_brand' => 'required',
            'medicine_category' => 'required',
            'medicine_quantity' => 'required',
            'medicine_no_of_milligrams' => 'required',
            'medicine_measurement' => 'required',
            'medicine_lot_number' => 'required',
            'medicine_date_of_manufacture' => 'required',
            'medicine_date_of_expiry' => 'required',
            'medicine_description' => 'required',
            'request_availability' => 'required',
            'medicine_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $medicine = Medicine::where('medicine_id', $medicine_id)->first();
        $medicine->medicine_name = $request->medicine_name;
        $medicine->medicine_brand = $request->medicine_brand;
        $medicine->medicine_category = $request->medicine_category;
        $medicine->medicine_quantity = $request->medicine_quantity;
        $medicine->medicine_no_of_milligrams = $request->medicine_no_of_milligrams;
        $medicine->medicine_measurement = $request->medicine_measurement;
        $medicine->medicine_lot_number = $request->medicine_lot_number;
        $medicine->medicine_date_of_manufacture = $request->medicine_date_of_manufacture;
        $medicine->medicine_date_of_expiry = $request->medicine_date_of_expiry;
        $medicine->medicine_description = $request->medicine_description;
        $medicine->request_availability = $request->request_availability;
                   //check if medicine_date_of_expiry is same as to current date
        if($request->medicine_date_of_expiry == date('Y-m-d'))
        {
            return back()->with('medicineNotUpdated', 'Date of expiry must be greater than today!');
        }
        else
        {
            $save = $medicine->save();

            if($save)
            {
                return redirect()->route('employee.medicines')->with('medicineUpdated', 'Medicine has been updated successfully!');
            }
            else
            {
                return redirect()->route('employee.medicines')->with('medicineNotUpdated', 'Something went wrong, try again later!');
            }
        }
    }

    //create search function for medicine name and brand name in the medicine table
    public function searchMedicine(Request $request)
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];
        $title = 'Medicines';
        $allMedicineCounts = Medicine::count();
        $allMedicines = Medicine::paginate(10);
        $getAllPending = MedicineRequest::where('request_status', 'Pending')->get();
        $UpcomingExpiringMedicines = Medicine::where('medicine_date_of_expiry', '<=', date('Y-m-d', strtotime('+7 days')))->get();
        $allMedicinesPaginated = Medicine::paginate(10);
        $allExpiredMedicinesToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();

        
        if(isset($_GET['search_medicine']))
        {
            $allMedicineCounts = Medicine::count();
            $search_medicine = $_GET['search_medicine'];
            $searchedMedicines = Medicine::where('medicine_name', 'LIKE', '%'.$search_medicine.'%')->paginate(10);
            //get links for pagination
            $searchedMedicines->appends(['search_medicine' => $search_medicine]);
            $expiredToday = ExpiredMedicine::where('medicine_date_of_expiry', '=', date('Y-m-d'))->get();
            

            return view('employee.medicines', $logged_data, compact('title', 'getAllPending', 'searchedMedicines', 'allMedicines', 'UpcomingExpiringMedicines', 'allMedicinesPaginated', 'allMedicineCounts', 'expiredToday'));
        }
        else
        {
            $medicines = Medicine::paginate(10);
            return view('employee.medicines', $logged_data, compact('title', 'getAllPending', 'medicines', 'allMedicines', 'UpcomingExpiringMedicines', 'allMedicinesPaginated', 'allMedicineCounts', 'expiredToday'));
        }
    }

    public function deleteMedicine($medicine_id)
    {
        $deleteMedicine = Medicine::find($medicine_id);
        $delete = $deleteMedicine->delete();

        if($delete)
        {
            return redirect()->route('employee.medicines')->with('medicineDeleted', 'Medicine has been deleted successfully!');
        }
        else
        {
            return redirect()->route('employee.medicines')->with('medicineNotDeleted', 'Something went wrong, try again later!');
        }
    }

}
