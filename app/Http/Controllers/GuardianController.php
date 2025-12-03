<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::with('user')->latest()->paginate(10);
        return view('admin.guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guardians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Parent');

            Guardian::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'occupation' => $request->occupation,
                'address' => $request->address,
            ]);
        });

        return redirect()->route('admin.guardians.index')->with('success', 'Guardian created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        $guardian->load('user');
        return view('admin.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($guardian->user_id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($request, $guardian) {
            $guardian->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $guardian->update([
                'phone_number' => $request->phone_number,
                'occupation' => $request->occupation,
                'address' => $request->address,
            ]);
        });

        return redirect()->route('admin.guardians.index')->with('success', 'Guardian updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        DB::transaction(function () use ($guardian) {
            $user = $guardian->user;
            $guardian->delete();
            $user->delete();
        });

        return redirect()->route('admin.guardians.index')->with('success', 'Guardian deleted successfully.');
    }
}
