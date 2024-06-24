<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Boss;
use App\Models\ClearanceForm;
use App\Models\Location;
use App\Models\StakeholderLocation;
use App\Models\ClearanceFormApproval;
use App\Models\Stakeholder;

class empController extends Controller

{
    public function index(Request $request)
    {
        // Retrieve the employee_id from the session
        $employeeId = $request->session()->get('employee_id');

        // Find the employee by the given ID from the session
        $employees = Employee::where('EmployeeID', $employeeId)->get();

        // Get all bosses and clearance forms as before
        $bosses = Boss::all();
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)->get();
        // Return the view with the retrieved data
        return view('employees.request', compact('employees', 'bosses', 'clearanceForm'));
    }
    public function home()
    {
        $employees = Employee::all();
        return view('employees.clearance', compact('employees'));
    }
    public function clearance(Request $request)
    {
        $employeeId = $request->session()->get('employee_id');
        $locations = Location::all();
        $employees = Employee::all();
        $stakeholders = Stakeholder::all();
        $stakeholderLocations = StakeholderLocation::all();
        $clearanceForms = ClearanceForm::where('EmployeeID', $employeeId)
            ->where('Status', 'APPROVED')
            ->get();
        $clearanceApprovals = ClearanceFormApproval::whereIn('ClearanceFormID', $clearanceForms->pluck('ClearanceFormID'))->get();

        return view('employees.clearance', compact(
            'employees',
            'locations',
            'stakeholders',
            'stakeholderLocations',
            'clearanceForms',
            'clearanceApprovals'
        ));
    }

    public function request()
    {
        $employees = Employee::all();
        return view('admin.request', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->File_number = $request->input('File_number');
        $employee->FirstName = $request->input('FirstName');
        $employee->LastName = $request->input('LastName');
        $employee->Workdep = $request->input('Workdep');
        $employee->Workname = $request->input('Workname');
        $employee->email = $request->input('email');
        $employee->Password = $request->input('Password');
        $employee->save();
        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        return view('main', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->File_number = $request->input('File_number');
        $employee->FirstName = $request->input('FirstName');
        $employee->LastName = $request->input('LastName');
        $employee->Workdep = $request->input('Workdep');
        $employee->Workname = $request->input('Workname');
        $employee->email = $request->input('email');
        $employee->Password = $request->input('Password');
        $employee->save();
        return redirect()->route('employees.index');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
