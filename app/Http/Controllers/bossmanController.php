<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Boss;
use App\Models\ClearanceForm;
use App\Models\Location;
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