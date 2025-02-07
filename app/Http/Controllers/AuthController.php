<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function change_password()
    {
        return view('auth.change_password');
    }

    public function change_password_post(Request $request)
    {
        // Validate the new password
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed', 
            'new_password_confirmation' => 'required',
            // Ensure that the new_password_confirmation field is included in the form
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('change_password')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('change_password')
                ->with('error', 'The current password is incorrect.');
        }
    
        // Ensure the user is authenticated
        if (Auth::check()) {
            // Update the password
            Auth::user()->update([
                'password' => Hash::make($request->new_password),
            ]);
    
            return redirect()->route('change_password')
                ->with('success', 'Password changed successfully.');
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to change your password.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
    

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            
        ]);

        $data = new User();

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);

        if ($data->save()) {
            return redirect()->back()->with('success','Employee Added Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }


    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Retrieve the credentials
        $credentials = $request->only('email', 'password');
    
        // Attempt authentication
        if (Auth::attempt($credentials)) {
            // Retrieve the authenticated user's role

                if (Auth::user()) {
                    return redirect()->route('employees.index')->with('success', 'Login Successfully');
                }

                elseif (Auth::employee()) {
                    return redirect()->route('leaves.index')->with('success', 'Login Successfully');
                }
           
                
            
        }
    
        // Authentication failed
        return redirect()->back()->with('error', 'Email or password is incorrect.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
