<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\StakeholderLocation;
use App\Models\Boss;
use App\Models\Substake;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
    
        $employee = Employee::where('email', $credentials['email'])->first();
    
        if ($employee && Hash::check($credentials['password'], $employee->Password)) {
            Auth::login($employee);
            $request->session()->put('employee_id', $employee->EmployeeID);
            return redirect()->intended('/emp');
        }

        $boss = Boss::where('email', $credentials['email'])->first();
        
        if ($boss && Hash::check($credentials['password'], $boss->Password)) {
            Auth::login($boss);
            $request->session()->put('boss_id', $boss->BossID);
            return redirect()->intended('/boss');
        }
        
        $stakeholder = StakeholderLocation::where('Email', $credentials['email'])->first();
        
        if ($stakeholder && Hash::check($credentials['password'], $stakeholder->Password)) {
            Auth::login($stakeholder);
            $request->session()->put('stakeholder_id', $stakeholder->StakeholderID);
            $request->session()->put('stakeholderlocation_id', $stakeholder->StakeholderLocationID);
            return redirect()->intended('/stake');
        }
        $admin = Admin::where('email', $credentials['email'])->first();
        
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
            $request->session()->put('admin_id', $admin->id);
            return redirect()->intended('/admin');
        }
        $substake = Substake::where('email', $credentials['email'])->first();
        
        if ($admin && Hash::check($credentials['password'], $substake->password)) {
            Auth::login($substake);
            $request->session()->put('sub_id', $substake->SubstakesID);
            return redirect()->intended('/subs');
        }

    
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget(['employee_id', 'boss_id', 'stakeholder_id', 'stakeholderlocation_id','admin_id']);
        return redirect()->route('login');
    }
}
