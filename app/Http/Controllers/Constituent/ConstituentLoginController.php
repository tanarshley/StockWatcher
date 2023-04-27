<?php

namespace App\Http\Controllers\Constituent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Constituent;

class ConstituentLoginController extends Controller
{
    public function showLogin()
    {
        $title = 'StockWatcher';
        return view('constituent.login', ['title' => $title]);
    }

    public function loginConstituent(Request $request)
    {
        $request->validate([
            'household_id' => 'required',
            'constituent_password' => 'required',
        ]);

        $constituent = Constituent::where('household_id','=', $request->household_id)->first();

        if(!$constituent)
        {
            return back()->with('constituentNotFound', 'Account not found, please try again');
        }
        else{
            if(Hash::check($request->constituent_password, $constituent->constituent_password))
            {
                $request->session()->put('LoggedConstituent', $constituent->constituent_id);
                return redirect()->route('constituent.requests')->with('loginConstituentSuccess', 'Successfully logged in');
            }
            else
            {
                return back()->with('loginConstituentIncorrect', 'Incorrect password, please try again');
            }
        }
    }
}
