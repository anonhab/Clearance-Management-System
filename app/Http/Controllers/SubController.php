<?php

namespace App\Http\Controllers;

use App\Models\Substake;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubstakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subId = $request->session()->get('sub_id');
        $substakes = Substake::findOrFail($subId);
        return view('substake.substake',compact('substakes'));
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



    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $substake = new Substake();

        if (!$substake) {
            abort(404, 'Employee not found in session.');
        }

        $substake = Substake::all();

        if (!$substake || !$substake->image) {
            abort(404, 'Image not found.');
        }

        return response($substake->image)->header('Content-Type', 'image/jpeg');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $substake = Substake::find($id);
        if (!$substake) {
            return redirect()->back()->with('error', 'Substake not found.')->withInput();
        }
        try {
            $substake->SubstakesID = $request->input('SubstakesID');
            $substake->StakeholderLocationID = $request->input('StakeholderLocationID');
            $substake->FullName = $request->input('FullName');
            $substake->Workdep = $request->input('Workdep');
            $substake->email = $request->input('email');

            if ($request->input('password')) {
                $substake->password = Hash::make($request->input('password'));
            }
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image);
                $substake->image = $imageData;
            }
    
            $substake->save();
    
            return redirect()->route('substakes.index')->with('success', 'Substake updated successfully');
        } catch (QueryException $e) {
            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.')->withInput();
        }
    }
    public function destroy($id)
    {
        $substake = Substake::find($id);
    

        $substake->delete();
        return redirect()->route('substakes.index')->with('success', 'Substake deleted successfully');
    }
}
