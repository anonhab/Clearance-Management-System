<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceForm;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CleanUpdateController extends Controller
{
    public function index()
    {
        $clearanceForms = ClearanceForm::all();
        return back();
    }

    public function create()
    {
        return view('clearanceForms.create');
    }

    public function store(Request $request)
    {
        $clearanceForm = new ClearanceForm();
        $clearanceForm->Status = $request->input('Status');
        $clearanceForm->save();
        return redirect()->route('clearanceForms.index')->with('success', 'SUbmitted successfully');
    }


    public function show($id)
    {
        try {
            // Find the employee by EmployeeID
            $clearanceForm = ClearanceForm::findOrFail($id);
            // Pass the found employee to the view
            return view('showclear', compact('clearanceForm'));
        } catch (ModelNotFoundException $exception) {
            abort(404); // or redirect, display an error message, etc.
            // Handle the case where the employee is not found

        }
    }


    public function edit(ClearanceForm $clearanceForm)
    {
        return view('clearanceForms.edit', compact('clearanceForm'));
    }

    public function update(Request $request, $id)
    {
        $clearanceForm = ClearanceForm::find($id);
        if ($clearanceForm) {
            $clearanceForm->Status = $request->input('Status');
            $clearanceForm->save();
            return redirect()->route('clearanceForms.index')->with('success', 'Submitted  successfully');
        } else {
            return redirect()->route('clearanceForms.index')->with('error', 'Clearance Form not found');
        }
    }

    public function destroy(ClearanceForm $clearanceForm)
    {
        $clearanceForm->delete();
        return redirect()->route('clearanceForms.index');
    }
}
