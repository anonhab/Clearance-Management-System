<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stakeholder;

class StakeholderController extends Controller
{
    public function index()
    {
        $stakeholders = Stakeholder::all();
        return view('admin.stakeholders', compact('stakeholders'));
    }
    public function store(Request $request)
    {
        $stakeholder = new Stakeholder();
        $stakeholder->Workdep = $request->input('Workdep');
        $stakeholder->FullName = $request->input('FullName');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image);
            $stakeholder->image = $imageData;
        }
        $stakeholder->save();
        return back()->withInput();
    }
    public function show(Stakeholder $stakeholder)
    {
        return view('stakeholders.show', compact('stakeholder'));
    }
    public function update(Request $request, Stakeholder $stakeholder)
    {
        $stakeholder->Workdep = $request->input('Workdep');
        $stakeholder->FullName = $request->input('FullName');
        $stakeholder->Email = $request->input('Email');
        $stakeholder->Password = $request->input('Password');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image);
            $stakeholder->image = $imageData;
        }
        $stakeholder->save();
        return back()->withInput()->with('success', 'stakeholder updated successfully');
    }

    public function destroy(Stakeholder $stakeholder)

    {
    
        $stakeholder->delete();
        return back()->withInput();
    }
}