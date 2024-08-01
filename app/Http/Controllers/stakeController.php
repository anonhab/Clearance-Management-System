<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Boss;
use App\Models\ClearanceForm;
use App\Models\Location;
use App\Models\ClearanceFormApproval;
use App\Models\Stakeholder;
use App\Models\StakeholderLocation;
use App\Models\Substake;
use App\Models\SubstakeApproval;
use Illuminate\Support\Facades\Hash;

class stakeController extends Controller

{

    public function index(Request $request)
    {
        $stakeId = $request->session()->get('stakeholderlocation_id');
        $stake = StakeholderLocation::find($stakeId);
        $substake = Substake::where('StakeholderLocationID', $stakeId)->get();
        $substakeapproval = SubstakeApproval::where('StakeholderLocationID', $stakeId)->get();
        $hasrequest = ClearanceForm::where('hasRequest', 'true')->get();
        $clearanceApproval = ClearanceFormApproval::where('StakeholderLocationID', $stakeId)
        ->where('ApprovalStatus', 'Pending')->get();
        return view('stakeholders.stakeholders', compact('clearanceApproval', 'stake', 'hasrequest', 'substake', 'substakeapproval'));
    }
    public function setEmployeeIdInSession($employeeId)
    {
        // Set the employee ID in the session
        session()->put('employee_id', $employeeId);

        // Retrieve the employee ID from the session
        $employeeId = session()->get('employee_id');

        // Fetch necessary data
        $locations = Location::all();
        $employees = Employee::findOrFail($employeeId);
        $stakeholders = Stakeholder::all();
        $stakeholderLocations = StakeholderLocation::all();
        $clearanceForms = ClearanceForm::where('EmployeeID', $employeeId)
            ->where('Status', 'APPROVED')
            ->get();
        $bossname = Boss::all();
        $clearanceApprovals = ClearanceFormApproval::whereIn('ClearanceFormID', $clearanceForms->pluck('ClearanceFormID'))->get();

        // Return the view with the fetched data
        return view('stakeholdersprint', compact(
            'employees',
            'locations',
            'stakeholders',
            'stakeholderLocations',
            'clearanceForms',
            'clearanceApprovals',
            'bossname'
        ));
    }
    public function approveRequest(Request $request)
    {
        $employeeId = $request->session()->get('employee_id');
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)->first();

        if ($clearanceForm) {
            $clearanceForm->hasRequest = "Approved";
            $clearanceForm->save();
        }

        return redirect()->route('stake.index');
    }
    public function home()
    {
        $employees = Employee::all();
        return view('employees.clearance', compact('employees'));
    }
    public function  profile(Request $request)
    {

        $stakeId = $request->session()->get('stakeholderlocation_id');
        $stake = StakeholderLocation::findOrFail($stakeId);
        $stake_id = $stake->StakeholderID;
        $stakeholder = Stakeholder::findOrFail($stake_id);
        return view('stakeholders.profile', compact('stakeholder', 'stake'));
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

        $stakeId = $request->session()->get('stakeholderlocation_id');
        $stake = StakeholderLocation::findOrFail($stakeId);
        if (!Hash::check($request->current_password, $stake->Password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        $stake->Password = Hash::make($request->new_password);
        $stake->save();

        return back()->with('success', 'Password changed successfully');
    }
    public function clearance()
    {
        $location = Location::all();
        $employees = Employee::all();
        return view('employees.clearance', compact('employees', 'location'));
    }
    public function showImage(Request $request)
    {
        $employeeId = $request->session()->get('stakeholder_id');

        if (!$employeeId) {
            abort(404, 'Employee not found in session.');
        }

        $employee = Stakeholder::find($employeeId);

        if (!$employee || !$employee->image) {
            abort(404, 'Image not found.');
        }

        return response($employee->image)->header('Content-Type', 'image/jpeg');
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

    public function show(Request $request)
    {

        $employeeId = $request->session()->get('stakeholder_id');

        if (!$employeeId) {
            abort(404, 'Employee not found in session.');
        }

        $employee = Stakeholder::find($employeeId);

        if (!$employee || !$employee->image) {
            abort(404, 'Image not found.');
        }

        return response($employee->image)->header('Content-Type', 'image/jpeg');
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
