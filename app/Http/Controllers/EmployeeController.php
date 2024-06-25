<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Employee;
use App\Models\ClearanceForm;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee', compact('employees'));
    }
    public function home()
    {
        $employees = Employee::all();
        return view('home', compact('employees'));
    }
    public function showinfo(Request $request){
        $employeeId = $request->session()->get('employee_id');
        $clearanceForm = ClearanceForm::where('EmployeeID', $employeeId)->get();
        return view('employees.requirement', compact('clearanceForm'));
    }

    public function request()
    {
        $employees = Employee::all();
        return view('request', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

   
public function store(Request $request)
{
    try{
    $employee = new Employee();
    $employee->File_number = $request->input('File_number');
    $employee->FirstName = $request->input('FirstName');
    $employee->LastName = $request->input('LastName');
    $employee->Workdep = $request->input('Workdep');
    $employee->Workname = $request->input('Workname');
    $employee->email = $request->input('email');
    $employee->Password = Hash::make($request->input('Password'));
    $employee->save();

    return redirect()->route('employees.index')->with('success', 'Employee added successfully');
} catch (QueryException $e) {
    if ($e->getCode() === '23000') {
     
        $errorMessage = 'The email  already exists.';
        return redirect()->back()->with('error', $errorMessage);
    }
    // Handle other possible exceptions
    return redirect()->back()->with('error', 'An unexpected error occurred.');
}
}


public function show($id)
{
    try {
        // Find the employee by EmployeeID
        $employee = Employee::findOrFail($id);

        // Pass the found employee to the view
        return view('showemp', compact('employee'));
    } catch (ModelNotFoundException $exception) {
        // Handle the case where the employee is not found
        abort(404); // or redirect, display an error message, etc.
    }
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
        $employee->Password = Hash::make($request->input('Password'));
        $employee->save();
        return redirect()->route('employees.index')->with('success', 'Employee Updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}