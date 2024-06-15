<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceForm;
use Illuminate\Database\QueryException;

class ClearanceFormController extends Controller
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
        $clearanceForm->EmployeeID = $request->input('EmployeeID');
        $clearanceForm->BossID = $request->input('BossID');
        $clearanceForm->Leaving_case = $request->input('Leaving_case');
        $clearanceForm->RequestDate = $request->input('RequestDate');
        $clearanceForm->Status = $request->input('Status');
        $clearanceForm->save();
        return redirect()->route('clearanceForms.index')->with('success', 'Clearance form submitted successfully.');
    }

    public function show(ClearanceForm $clearanceForm)
    {
        return view('clearanceForms.show', compact('clearanceForm'));
    }

    public function edit(ClearanceForm $clearanceForm)
    {
        return view('clearanceForms.edit', compact('clearanceForm'));
    }

    public function update(Request $request, ClearanceForm $clearanceForm)
    {
        $clearanceForm->EmployeeID = $request->input('EmployeeID');
        $clearanceForm->BossID = $request->input('BossID');
        $clearanceForm->Leaving_case = $request->input('Leaving_case');
        $clearanceForm->RequestDate = $request->input('RequestDate');
        $clearanceForm->Status = $request->input('Status');
        $clearanceForm->save();
        return redirect()->route('clearanceForms.index');
    }

    public function destroy(ClearanceForm $clearanceForm)
    {
        try {
            $clearanceForm->delete();
            return redirect()->route('clearanceForms.index');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                // Foreign key constraint error
                return back()->withError('Cannot delete clearance form because it has related approvals.');
            } else {
                // Other database error
                return back()->withError('An error occurred while deleting the clearance form.');
            }
        }
    }
}