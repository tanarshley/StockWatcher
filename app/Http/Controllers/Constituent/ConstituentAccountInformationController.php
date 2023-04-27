<?php

namespace App\Http\Controllers\Constituent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Constituent;
use Illuminate\Support\Facades\Hash;

class ConstituentAccountInformationController extends Controller
{
    public function showAccountInformation()
    {
        $logged_data = ['LoggedConstituent'=>Constituent::where('constituent_id', session('LoggedConstituent'))->first()];
        $title = 'Account Information';
        return view('constituent.account-information', $logged_data, compact('title'));
    }

    public function editAccountInformation(Request $request, $constituent_id)
    {
        $request->validate([
            'constituent_email' => 'required|email|unique:constituents,constituent_email,'.$constituent_id.',constituent_id',
            'constituent_phone' => 'required|digits:11|unique:constituents,constituent_phone,'.$constituent_id.',constituent_id',
            'constituent_address' => 'required',
        ]);

        $constituent = Constituent::find($constituent_id);
        $constituent->constituent_email = $request->constituent_email;
        $constituent->constituent_phone = $request->constituent_phone;
        $constituent->constituent_address = $request->constituent_address;
        $save = $constituent->save();

        if($save)
        {
            return back()->with('constituentUpdated', 'Profile Information updated successfully');
        }
        else
        {
            return back()->with('constituentNotUpdated', 'Something went wrong, please try again');
        }
    }

    public function editAccountPassword(Request $request, $constituent_id)
    {
        $request->validate([
            'constituent_password' => 'required',
            'new_password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $constituent = Constituent::find($constituent_id);
        $current_password = $constituent->constituent_password;
        if(Hash::check($request->constituent_password, $current_password))
        {
            $constituent->constituent_password = Hash::make($request->new_password);
            $save = $constituent->save();

            if($save)
            {
                return back()->with('constituentPasswordUpdated', 'Password updated successfully');
            }
            else
            {
                return back()->with('constituentPasswordNotUpdated', 'Something went wrong, please try again');
            }
        }
        else
        {
            return back()->with('constituentIncorrectCurrentPassword', 'Current password is incorrect');
        }
    }
}
