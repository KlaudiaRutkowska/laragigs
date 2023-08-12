<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthenticateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show register/creating form
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $formFields = $request->validated();

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields);

        //login user
        auth()->login($user);

        return redirect('/')->with('success', 'User created and logged successfully!');
    }

    public function login(Request $request)
    {
        return view('users.login');
    }

    public function authenticate(StoreAuthenticateUserRequest $request)
    {
        $formFields = $request->validated();

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()
                ->route('home')
                ->with('success', 'You have been logged successfully!');
        }

        return back()->withErrors(['email' => 'invalid'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        //logout user
        Auth::logout();
        //remove authentication information from user session
        //invalidate user session
        $request->session()->invalidate();
        //regenerate token
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'User has been logged out successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
