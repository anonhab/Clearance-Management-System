<?php

namespace App\Http\Controllers;

use App\Models\SubstakeApproval;
use Illuminate\Http\Request;

class SubstakeApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvals = SubstakeApproval::all();
        return response()->json($approvals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'SubstakesID' => 'required|integer',
            'ClearanceFormID' => 'nullable|integer',
            'ApprovalStatus' => 'nullable|string|max:50',
            'Comments' => 'nullable|string',
        ]);

        $approval = SubstakeApproval::create($request->all());
        return response()->json($approval, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $approval = SubstakeApproval::find($id);
        if (is_null($approval)) {
            return response()->json(['message' => 'Approval not found'], 404);
        }
        return response()->json($approval);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'SubstakesID' => 'required|integer',
            'ClearanceFormID' => 'nullable|integer',
            'ApprovalStatus' => 'nullable|string|max:50',
            'Comments' => 'nullable|string',
        ]);

        $approval = SubstakeApproval::find($id);
        if (is_null($approval)) {
            return response()->json(['message' => 'Approval not found'], 404);
        }

        $approval->update($request->all());
        return response()->json($approval);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $approval = SubstakeApproval::find($id);
        if (is_null($approval)) {
            return response()->json(['message' => 'Approval not found'], 404);
        }

        $approval->delete();
        return response()->json(['message' => 'Approval deleted successfully']);
    }
}
