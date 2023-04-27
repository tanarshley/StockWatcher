<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeLogoutController extends Controller
{
    public function logout()
    {
        if(session()->has('LoggedEmployee')){
            session()->pull('LoggedEmployee');
            return redirect('employee/login');
        }
    }
}
