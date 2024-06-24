<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Boss;
use App\Models\ClearanceForm;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;

class bossmanController extends Controller

{
    
    public function index(Request $request)
    {
        $bossId = $request->session()->get('boss_id');
        // $employees = Employee::all();
        // $bosses=Boss::all();
        $clearanceForm = ClearanceForm::where('BossID', $bossId)->get();
        return view('bosses.boss', compact('clearanceForm'));
    }
    public function home()
    {
        $employees = Employee::all();
        return view('employees.clearance', compact('employees'));
    }
    public function  profile(Request $request)
    {

        $bossId = $request->session()->get('boss_id');
        $boss = Boss::findOrFail($bossId);
        return view('bosses.profile', compact('boss'));
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

        $bossId = $request->session()->get('boss_id');
        $boss = Boss::findOrFail($bossId);
        if (!Hash::check($request->current_password, $boss->Password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        $boss->Password = Hash::make($request->new_password);
        $boss->save();

        return back()->with('success', 'Password changed successfully');
    }
    public function clearance()
    {
        $location = Location::all();
        $employees = Employee::all();
        return view('employees.clearance', compact('employees','location'));
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