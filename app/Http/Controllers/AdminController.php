<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        try {
            $admin = new Admin();
            $admin->full_name = $request->input('full_name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->save();

            return redirect()->route('admin.index');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                $errorMessage = 'The email already exists.';
                return redirect()->back()->with('error', $errorMessage);
            }

            // Handle other possible exceptions
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->full_name = $request->input('full_name');
        $admin->email = $request->input('email');
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->save();

        return redirect()->route('admin.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index');
    }
}
