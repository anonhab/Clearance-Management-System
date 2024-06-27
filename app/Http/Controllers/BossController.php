<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Boss;
use Illuminate\Database\QueryException;

class BossController extends Controller
{
    public function index()
    {
        $bosses = Boss::all();
        return view('admin.bosses', compact('bosses'));
    }

    public function create()
    {
        return view('bosses.create');
    }

    public function store(Request $request)
{
    try {
 
        $boss = new Boss();
        $boss->Full_name = $request->input('Full_name');
        $boss->Responsibility = $request->input('Responsibility');
        $boss->Email = $request->input('Email');
        $boss->Password = Hash::make($request->input('Password'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image);
            $boss->image = $imageData;
        }

        $boss->save();

        return redirect()->route('bosses.index')->with('success', 'Boss created successfully');
    } catch (QueryException $e) {
        if ($e->getCode() === '23000') {
            $errorMessage = 'The email already exists.';
            return redirect()->back()->with('error', $errorMessage);
        }

         
        return redirect()->back()->with('error', 'An unexpected error occurred.');
    } catch (\Exception $e) {
        // Log any other exceptions
         
        return redirect()->back()->with('error', 'An unexpected error occurred.');
    }
}


    public function show(Boss $boss)
    {
        return view('bosses.show', compact('boss'));
    }

    public function edit(Boss $boss)
    {
        return view('bosses.edit', compact('boss'));
    }

    public function update(Request $request, Boss $boss)
    {
        $boss->Full_name = $request->input('Full_name');
        $boss->Responsibility = $request->input('Responsibility');
        $boss->Email = $request->input('Email');
        $boss->Password = Hash::make($request->input('Password'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image);
            $boss->image = $imageData;
        }
        $boss->save();
        return redirect()->route('bosses.index');
    }

    public function destroy(Boss $boss)
    {
        $boss->delete();
        return redirect()->route('bosses.index')->with('success', 'Boss Deleted successfully');
    }
}
