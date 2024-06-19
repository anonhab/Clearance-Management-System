<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Boss;
use App\Models\Stakeholder;
use App\Models\StakeholderLocation;
use App\Models\Location;
use Illuminate\Database\QueryException;

class admindash extends Controller
{
    public function index()
{
    $employees = Employee::all();
    $bosses = Boss::all();
    $stakeholders = Stakeholder::all();
    $stakeholderLocations = StakeholderLocation::all();
    $locations = Location::all();
    return view('admin.dashboard', compact('employees', 'bosses', 'stakeholders', 'stakeholderLocations', 'locations'));
}


    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
         
    }

    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->full_name = $request->input('full_name');
        $admin->email = $request->input('email');
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();

        return redirect()->route('admin.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index');
    }
}
