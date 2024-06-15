<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeLocation;

class EmployeeLocationController extends Controller
{
    public function index()
    {
        $employeeLocations = EmployeeLocation::all();
        return view('employeeLocations.index', compact('employeeLocations'));
    }

    public function create()
    {
        return view('employeeLocations.create');
    }

    public function store(Request $request)
    {
        $employeeLocation = new EmployeeLocation();
        $employeeLocation->EmployeeID = $request->input('EmployeeID');
        $employeeLocation->LocationID = $request->input('LocationID');
        $employeeLocation->save();
        return redirect()->route('employeeLocations.index');
    }

    public function show(EmployeeLocation $employeeLocation)
    {
        return view('employeeLocations.show', compact('employeeLocation'));
    }

    public function edit(EmployeeLocation $employeeLocation)
    {
        return view('employeeLocations.edit', compact('employeeLocation'));
    }

    public function update(Request $request, EmployeeLocation $employeeLocation)
    {
        $employeeLocation->EmployeeID = $request->input('EmployeeID');
        $employeeLocation->LocationID = $request->input('LocationID');
        $employeeLocation->save();
        return redirect()->route('employeeLocations.index');
    }

    public function destroy(EmployeeLocation $employeeLocation)
    {
        $employeeLocation->delete();
        return redirect()->route('employeeLocations.index');
    }
}