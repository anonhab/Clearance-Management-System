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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class empController extends Controller

{
    public function index(Request $request)
    {
        $employeeId = $request->session()->get('employee_id');
        $employees = Employee::where('EmployeeID', $employeeId)->get();
        foreach($employees as $employe){
        $boss = Boss::findOrFail($employe->BossID);
        }
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)->get();
        return view('employees.request', compact('employees','boss','clearanceForm'));
    }
    public function home()
    {
        $employees = Employee::all();
        return view('employees.clearance', compact('employees'));
    }
    public function hasRequest(Request $request)
    {
        $employeeId = $request->session()->get('employee_id');
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)->first();
    
        if ($clearanceForm) {
            $clearanceForm->hasRequest = "true";
            $clearanceForm->save();
        }
    
        return redirect()->back();
        
    }
    
    public function  profile(Request $request)
    {

        $employeeId = $request->session()->get('employee_id');
        $employees = Employee::findOrFail($employeeId);
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)
            ->where('Status', 'APPROVED')
            ->get();
        return view('employees.profile', compact('employees', 'clearanceForm'));
    }
    public function changePassword(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'current_password' => 'required',
        //     'new_password' => 'required|min:8|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput()->with('modal', 'changePasswordModal');
        // }

        $employeeId = $request->session()->get('employee_id');
        $employee = Employee::findOrFail($employeeId);
        if (!Hash::check($request->current_password, $employee->Password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        $employee->Password = Hash::make($request->new_password);
        $employee->save();

        return back()->with('success', 'Password changed successfully');
    }
    public function showImage(Request $request)
    {
        $employeeId = $request->session()->get('employee_id');

        if (!$employeeId) {
            abort(404, 'Employee not found in session.');
        }

        $employee = Employee::find($employeeId);

        if (!$employee || !$employee->image) {
            abort(404, 'Image not found.');
        }

        return response($employee->image)->header('Content-Type', 'image/jpeg');
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
    public function print(Request $request){
        $employeeId = $request->session()->get('employee_id');
        $locations = Location::all();
        $employees = Employee::findOrFail($employeeId);
        $stakeholders = Stakeholder::all();
        $stakeholderLocations = StakeholderLocation::all();
        $clearanceForms = ClearanceForm::where('EmployeeID', $employeeId)
            ->where('Status', 'APPROVED')
            ->get();
        
        $bossname = Boss::all();
        
        $clearanceApprovals = ClearanceFormApproval::whereIn('ClearanceFormID', $clearanceForms->pluck('ClearanceFormID'))->get();

        return view('employees.print', compact(
            'employees',
            'locations',
            'stakeholders',
            'stakeholderLocations',
            'clearanceForms',
            'clearanceApprovals',
            'bossname'
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
        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
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
