<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function setPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:employees,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please correct the errors below.');
    }

    $employee = Employee::where('email', $request->email)->first();

    if (!$employee) {
        return redirect()->back()->with('error', 'Employee not found.');
    }

    $employee->password = Hash::make($request->password);
    $employee->save();

    return redirect()->route('login')->with('success', 'Password set successfully. You can now log in.');
}

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

   public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        // Identify user type
        if (User::where('email', $email)->exists()) {
            $broker = 'users';
        } elseif (Employee::where('email', $email)->exists()) {
            $broker = 'employees';
        } else {
            return back()->withErrors(['email' => 'This email is not registered.']);
        }

        // Send reset link
        $status = Password::broker($broker)->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Reset link sent successfully.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ]);

    $email = $request->input('email');

    // Check if email exists in users
    if (User::where('email', $email)->exists()) {
        $broker = 'users';
        $modelClass = User::class;
        $emailExistsRule = 'exists:users,email';
    }
    // Else check employees
    elseif (Employee::where('email', $email)->exists()) {
        $broker = 'employees';
        $modelClass = Employee::class;
        $emailExistsRule = 'exists:employees,email';
    } else {
        // Email does not exist in either table
        return back()->withErrors(['email' => 'Email not found in our records.']);
    }

    // Re-validate email existence in the correct table
    $request->validate([
        'email' => ['required', 'email', $emailExistsRule],
    ]);

    $status = Password::broker($broker)->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($modelClass) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', 'Password has been reset.')
        : back()->withErrors(['email' => 'Reset failed.']);
}

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
        ]);

        if ($validator->fails()) {
          return redirect()->route('change_password')
            ->withErrors($validator)
            ->withInput();
        }

        // Determine which guard the user is logged into (employee or user)
        if (Auth::guard('employee')->check()) {
           // Employee is logged in
           $authUser = Auth::guard('employee')->user();
           } elseif (Auth::guard('web')->check()) {
              // User (admin) is logged in
              $authUser = Auth::guard('web')->user();
           } else {
             // If neither is authenticated
             return redirect()->route('login')->with('error', 'You need to be logged in to change your password.');
             }

           // Check if the current password matches the stored password for the correct user
           if (!Hash::check($request->current_password, $authUser->password)) {
             return redirect()->route('change_password')
            ->with('error', 'The current password is incorrect.');
            }

           // Update the password
           $authUser->update([
           'password' => Hash::make($request->new_password),
           ]);

           // Log the user out after password change, to prevent session conflicts
           Auth::guard($authUser instanceof \App\Models\User ? 'web' : 'employee')->logout();

           // Redirect user to the login page with success message
           return redirect()->route('login')
           ->with('success', 'Password changed successfully. Please log in again.');
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
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Attempt login as Admin (User)
    if (Auth::guard('web')->attempt($credentials)) {
        return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
    }

    // Attempt login as Employee
    if (Auth::guard('employee')->attempt($credentials)) {
        return redirect()->route('employees.dashboard')->with('success', 'Login Successfully');
    }

    return redirect()->back()->with('error', 'Email or password is incorrect.');
    }

}
