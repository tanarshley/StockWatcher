<?php

namespace App\Http\Controllers\Constituent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constituent;

class ConstituentLogoutController extends Controller
{
    public function logout()
    {
        if(session()->has('LoggedConstituent')){
            session()->pull('LoggedConstituent');
            return redirect('constituent/login');
        }
    }
}
