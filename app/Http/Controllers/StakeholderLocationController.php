<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StakeholderLocation;
use App\Models\Stakeholder;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
class StakeholderLocationController extends Controller
{
    public function index()
    {
        $stakeholderLocations = StakeholderLocation::all();
        $location = Location::all();
        $stakeholder = Stakeholder::all();
        return view('admin.stakelocations', compact('stakeholderLocations', 'location', 'stakeholder'));
    }

    public function create()
    {
        return view('stakeholderLocations.create');
    }

    public function store(Request $request)
    {
        try {
            $stakeholderLocation = new StakeholderLocation();
            $stakeholderLocation->StakeholderID = $request->input('StakeholderID');
            $stakeholderLocation->LocationID = $request->input('LocationID');
            $stakeholderLocation->Email = $request->input('email');
            $stakeholderLocation->Password =  Hash::make($request->input('Password'));
            $stakeholderLocation->Priority = $request->input('Priority');
            $stakeholderLocation->save();
            return redirect()->route('stakeholderLocations.index')->with('success', 'stakeholder location add successfully');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
             
                $errorMessage = 'The email  already exists.';
                return redirect()->back()->with('error', $errorMessage);
            }

            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function show(StakeholderLocation $stakeholderLocation)
    {
        return view('stakeholderLocations.show', compact('stakeholderLocation'));
    }

    public function edit(StakeholderLocation $stakeholderLocation)
    {
        return view('stakeholderLocations.edit', compact('stakeholderLocation'));
    }

    public function update(Request $request, StakeholderLocation $stakeholderLocation)
    {
        $stakeholderLocation->StakeholderID = $request->input('StakeholderID');
        $stakeholderLocation->LocationID = $request->input('LocationID');
        $stakeholderLocation->save();
        return redirect()->route('stakeholderLocations.index')->with('success', 'stakeholder location updated successfully');
    }

    public function destroy(StakeholderLocation $stakeholderLocation)
    {
        $stakeholderLocation->delete();
        return redirect()->route('stakeholderLocations.index');
    }
}
