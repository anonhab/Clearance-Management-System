<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceForm;
use App\Models\ClearanceFormApproval;

class cleanappController extends Controller
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
        return redirect()->route('clearanceForms.index');
    }

    public function show(ClearanceForm $clearanceForm)
    {
        return view('clearanceForms.show', compact('clearanceForm'));
    }

    public function edit(ClearanceForm $clearanceForm)
    {
        return view('clearanceForms.edit', compact('clearanceForm'));
    }

    public function update(Request $request, $id)
    {
        $clearanceForm = ClearanceFormApproval::find($id);
        if ($clearanceForm) {
            $clearanceForm->ApprovalStatus = $request->input('ApprovalStatus');
            $clearanceForm->Comments = $request->input('Comments');
            $clearanceForm->save();
            return redirect()->route('clearanceForms.index');
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
