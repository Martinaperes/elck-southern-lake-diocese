<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Validate user + member fields
        $request->validate([
            // User fields
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Member fields
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
            'date_of_birth' => ['nullable','date'],
            'joined_at' => ['nullable','date'],
            'gender' => ['nullable','string', 'max:20'],
        ]);

        //  Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default role
        ]);

        //  Create the member profile
        $member = Member::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email, // optional duplicate
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth ?: null,
            'joined_at' => $request->joined_at ?: now()->toDateString(),
            'gender' => $request->gender,
            'is_active' => true,
        ]);

         // Generate membership number (optional)
    $member->membership_number = 'M' . str_pad($member->id, 5, '0', STR_PAD_LEFT);
    $member->save();

    // Fire registered event & login user
    event(new Registered($user));
    Auth::login($user);

    // Redirect to verification notice instead of dashboard
    return redirect(route('verification.notice'));

    }
}