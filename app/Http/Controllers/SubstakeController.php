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
    public function index()
    {
        $substakes = Substake::all();
        return view('stakeholders.substake',compact('substakes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'StakeholderLocationID' => 'required|integer',
            'FullName' => 'nullable|string|max:255',
            'Workdep' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Add validation for image file type and size
            'email' => 'required|string|email|max:255|unique:substakes,email',
            'password' => 'required|string|min:8', // Add validation for password
        ]);
    
        try {
            $substake = new Substake();
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
            if ($e->getCode() === '23000') {
                $errorMessage = 'The email already exists.';
                return redirect()->back()->with('error', $errorMessage)->withInput();
            }
    
            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.')->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $substake = Substake::find($id);
        if (is_null($substake)) {
            return response()->json(['message' => 'Substake not found'], 404);
        }
        return response()->json($substake);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'StakeholderLocationID' => 'required|integer',
            'FullName' => 'nullable|string|max:255',
            'Workdep' => 'nullable|string',
            'image' => 'nullable|image',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ]);

        $substake = Substake::find($id);
        if (is_null($substake)) {
            return response()->json(['message' => 'Substake not found'], 404);
        }

        $substake->update($request->all());
        return response()->json($substake);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $substake = Substake::find($id);
        if (is_null($substake)) {
            return response()->json(['message' => 'Substake not found'], 404);
        }

        $substake->delete();
        return response()->json(['message' => 'Substake deleted successfully']);
    }
}
