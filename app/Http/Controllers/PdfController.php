<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineRequest;
use App\Models\Employee;
use App\Models\Constituent;
use App\Models\Medicine;
use App\Models\ExpiredMedicine;
use App\Models\RequestHistory;
use App\Models\ReleaseHistory;

class PdfController extends Controller
{
    public function downloadMedicinesToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $medicines = Medicine::all();
        $pdf = \PDF::loadView('pdf.medicines', compact('medicines'), $logged_data);
        return $pdf->download('medicines '. date('Y-m-d') .'.pdf');
    }

    public function downloadExpiredMedicinesToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $expiredMedicines = ExpiredMedicine::all();
        $pdf = \PDF::loadView('pdf.expired-medicines', compact('expiredMedicines'), $logged_data);
        return $pdf->download('expired-medicines '. date('Y-m-d') .'.pdf');
    }

    public function downloadReleaseHistoryToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $release_history = ReleaseHistory::all();
        //get employee_id from release_history
        $employee_id = $release_history->pluck('employee_id');
        //get employee_info from employee_id
        $employeeInfo = Employee::whereIn('employee_id', $employee_id)->get();
        //get medicine_id from release_history
        $medicine_id = $release_history->pluck('medicine_id');
        $medicineInfo = Medicine::whereIn('medicine_id', $medicine_id)->get();

        $pdf = \PDF::loadView('pdf.release-history', compact('release_history', 'employee_id', 'medicineInfo', 'employeeInfo'), $logged_data);
        return $pdf->download('release-history '. date('Y-m-d') .'.pdf');
    }

    public function downloadMedicineRequestsToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $medicine_requests = MedicineRequest::all();
        //get constituent_id from medicine_requests
        $constituent_id = $medicine_requests->pluck('constituent_id');
        //get constituent_info from constituent_id
        $constituentInfo = Constituent::whereIn('constituent_id', $constituent_id)->get();

        $medicine_id = $medicine_requests->pluck('medicine_id');
        $medicineInfo = Medicine::whereIn('medicine_id', $medicine_id)->get();

        $pdf = \PDF::loadView('pdf.medicine-requests', compact('medicine_requests', 'constituentInfo', 'medicineInfo'), $logged_data);
        return $pdf->download('medicine-requests '. date('Y-m-d') .'.pdf');
    }

    public function downloadConstituentsToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $constituents = Constituent::all();
        $pdf = \PDF::loadView('pdf.constituents', compact('constituents'), $logged_data);
        return $pdf->download('constituents '. date('Y-m-d') .'.pdf');
    }

    public function downloadEmployeesToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $employees = Employee::all();
        $pdf = \PDF::loadView('pdf.employees', compact('employees'), $logged_data);
        return $pdf->download('employees '. date('Y-m-d') .'.pdf');
    }

    public function downloadRequestHistoryToPdf()
    {
        $logged_data = ['LoggedEmployee'=>Employee::where('employee_id', session('LoggedEmployee'))->first()];

        $medicine_requests = RequestHistory::all();
        $constituent_id = $medicine_requests->pluck('constituent_id');
        //get constituent_info from constituent_id
        $constituentInfo = Constituent::whereIn('constituent_id', $constituent_id)->get();

        $medicine_id = $medicine_requests->pluck('medicine_id');
        $medicineInfo = Medicine::whereIn('medicine_id', $medicine_id)->get();

        $pdf = \PDF::loadView('pdf.request-history', compact('medicine_requests', 'constituentInfo', 'medicineInfo'), $logged_data);
        return $pdf->download('request-history '. date('Y-m-d') .'.pdf');
    }
}
