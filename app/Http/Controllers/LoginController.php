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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only(['email', 'password']);
        
        if ($employee = Employee::where('email', $credentials['email'])->first()) {
            if (Hash::check($credentials['password'], $employee->Password)) {
                Auth::login($employee);
                $request->session()->put('employee_id', $employee->EmployeeID);
                return redirect()->intended('/emp');
            }
        }

        if ($boss = Boss::where('email', $credentials['email'])->first()) {
            if (Hash::check($credentials['password'], $boss->Password)) {
                Auth::login($boss);
                $request->session()->put('boss_id', $boss->BossID);
                return redirect()->intended('/boss');
            }
        }

        if ($stakeholder = StakeholderLocation::where('Email', $credentials['email'])->first()) {
            if (Hash::check($credentials['password'], $stakeholder->Password)) {
                Auth::login($stakeholder);
                $request->session()->put('stakeholder_id', $stakeholder->StakeholderID);
                $request->session()->put('stakeholderlocation_id', $stakeholder->StakeholderLocationID);
                return redirect()->intended('/stake');
            }
        }

        if ($admin = Admin::where('email', $credentials['email'])->first()) {
            if (Hash::check($credentials['password'], $admin->password)) {
                Auth::login($admin);
                $request->session()->put('admin_id', $admin->id);
                return redirect()->intended('/admin');
            }
        }

        if ($substake = Substake::where('email', $credentials['email'])->first()) {
            if (Hash::check($credentials['password'], $substake->password)) {
                Auth::login($substake);
                $request->session()->put('sub_id', $substake->SubstakesID);
                $request->session()->put('stakeholder_id', $substake->StakeholderLocationID);
                return redirect()->intended('/subs');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function homepage(Request $request)
    {
        return view('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget([
            'employee_id', 
            'boss_id', 
            'stakeholder_id', 
            'sub_id',
            'stakeholderlocation_id',
            'admin_id'
        ]);
        return redirect()->route('index');
    }
}
