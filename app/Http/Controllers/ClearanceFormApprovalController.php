<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\ClearanceFormApproval;

class ClearanceFormApprovalController extends Controller
{
    public function index()
    {
        $clearanceFormApprovals = ClearanceFormApproval::all();
        return back()->withInput();
    }

    public function create()
    {
        return view('clearanceFormApprovals.create');
    }

   
    public function store(Request $request)
    {
        // Validate and process the form submission...
    
        // Assuming successful validation and processing
        // Save clearance form approvals
        foreach ($request->StakeholderLocationID as $stakeholderLocationID) {
            $clearanceFormApproval = ClearanceFormApproval::firstOrCreate([
                'ClearanceFormID' => $request->input('ClearanceFormID'),
                'StakeholderLocationID' => $stakeholderLocationID,
            ], [
                'ApprovalDate' => $request->input('ApprovalDate'),
                'ApprovalStatus' => $request->input('ApprovalStatus'),
                'Comments' => $request->input('Comments'),
            ]);
    
            // If the record already exists, skip saving
            if (!$clearanceFormApproval->wasRecentlyCreated) {
                continue;
            }
        }
    
    
        return redirect()->route('clearanceFormApprovals.index')->with('success', 'Clearance form approvals submitted successfully.');
    }

    public function show(ClearanceFormApproval $clearanceFormApproval)
    {
        return view('clearanceFormApprovals.show', compact('clearanceFormApproval'));
    }

    public function edit(ClearanceFormApproval $clearanceFormApproval)
    {
        return view('clearanceFormApprovals.edit', compact('clearanceFormApproval'));
    }

    public function update(Request $request, ClearanceFormApproval $clearanceFormApproval)
    {
        $clearanceFormApproval->ClearanceFormID = $request->input('ClearanceFormID');
        $clearanceFormApproval->StakeholderID = $request->input('StakeholderID');
        $clearanceFormApproval->ApprovalDate = $request->input('ApprovalDate');
        $clearanceFormApproval->ApprovalStatus = $request->input('ApprovalStatus');
        $clearanceFormApproval->Comments = $request->input('Comments');
        $clearanceFormApproval->save();
        return redirect()->route('clearanceFormApprovals.index');
    }

    public function destroy(ClearanceFormApproval $clearanceFormApproval)
    {
        $clearanceFormApproval->delete();
        return redirect()->route('clearanceFormApprovals.index');
    }
}