<?php

namespace App\Http\Controllers;

use App\Models\StakeholderLocation;
use App\Models\Substake;
use App\Models\SubstakeApproval;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subId = $request->session()->get('sub_id');
        $subapproval = SubstakeApproval::where('SubstakesID', $subId)
        ->where('ApprovalStatus', 'Pending')
        ->get();                    $substakes = Substake::findOrFail($subId);
        return view('substake.substake',compact('substakes','subapproval'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        try {
            $substake = new Substake();
            $substake->SubstakesID = $request->input('SubstakesID');
            $substake->StakeholderLocationID = $request->input('StakeholderLocationID');
            $substake->FullName = $request->input('FullName');
            $substake->Workdep = $request->input('Workdep');
            $substake->email = $request->input('email');
            $substake->password = Hash::make($request->input('password'));
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image);
                $substake->image = $imageData;
            }
    
            $substake->save();
    
            return redirect()->route('substakes.index')->with('success', 'Substake added successfully');
        } catch (QueryException $e) {
    
            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.')->withInput();
        }
    }
    
    public function showImage(Request $request)
{
    // Fetch all substakes
    $substakes = Substake::all();

    // Check if there are any substakes
    if ($substakes->isEmpty()) {
        abort(404, 'No substakes found.');
    }

    // Iterate over each substake to show the image
    foreach ($substakes as $substake) {
        // Check if the substake has an image
        if ($substake->image) {
            return response($substake->image)->header('Content-Type', 'image/jpeg');
        }
    }

    // If no image is found in any substake
    abort(404, 'No image found for any substake.');
}
public function  profile(Request $request)
{

    $subid = $request->session()->get('sub_id');
    $sub = Substake::find($subid);
    $stakeid = $request->session()->get('stakeholder_id');
    $stake = StakeholderLocation::find($stakeid);
    return view('substake.profile', compact('sub','stake'));
}
public function changePassword(Request $request)
{

    $subid = $request->session()->get('sub_id');
    $sub = Substake::findOrFail($subid);
    if (!Hash::check($request->current_password, $sub->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
    }

    $sub->password = Hash::make($request->new_password);
    $sub->save();

    return back()->with('success', 'Password changed successfully');
}
public function bossshowImage(Request $request)
{
    $subid = $request->session()->get('sub_id');
    $sub = Substake::findOrFail($subid);

    if (!$sub) {
        abort(404, 'Employee not found in session.');
    }



    if (!$sub || !$sub->image) {
        abort(404, 'Image not found.');
    }

    return response($sub->image)->header('Content-Type', 'image/jpeg');
}



    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $subid = $request->session()->get('sub_id');
        $sub = Substake::findOrFail($subid);
    

        if (!$sub) {
            abort(404, 'Employee not found in session.');
        }

        $subid = $request->session()->get('sub_id');
        $sub = Substake::findOrFail($subid);

        if (!$subid || !$subid->image) {
            abort(404, 'Image not found.');
        }

        return response($subid->image)->header('Content-Type', 'image/jpeg');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clearanceForm = SubstakeApproval::find($id);
    
        if (!$clearanceForm) {
            return redirect()->back()->with('error', 'Clearance Form not found');
        }
    
        if (!$request->has('Status')) {
            return redirect()->back()->with('error', 'Status input is required');
        }
    
        $clearanceForm->ApprovalStatus = $request->input('Status');
    
        if (!$clearanceForm->save()) {
            return redirect()->back()->with('error', 'Failed to update Clearance Form');
        }
    
        return redirect()->back()->with('success', 'Submitted successfully');
    }
    public function destroy($id)
    {
        $substake = Substake::find($id);
    

        $substake->delete();
        return redirect()->route('substakes.index')->with('success', 'Substake deleted successfully');
    }
}
