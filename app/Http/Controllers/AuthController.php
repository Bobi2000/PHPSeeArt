<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (session()->has('logged') && session()->get('logged') == true) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {

            if(!isset($request->username)) {
                session()->flash('username-empty', 'The username can not be empty.');
            }

            if(!isset($request->email)) {
                session()->flash('email-empty', 'The email can not be empty.');
            }

            if(!isset($request->password)) {
                session()->flash('password-empty', 'The password can not be empty.');
            }

            if(!isset($request->username) || !isset($request->email) || !isset($request->password)) {
                return view('register');
            }

            // $validator = validator($request->all(), [
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|string|email|max:255|unique:users',
            //     'password' => 'required|string|min:8|confirmed',
            // ]);

            // if ($validator->fails()) {
            //     return redirect('register')
            //         ->withErrors($validator)
            //         ->withInput();
            // }

            // $emailExist = User::where('email', $validator['email'])->first();

            // if ($emailExist) {
            //     return redirect()->back()->withErrors(['email' => 'The email is already registered']);
            // }

            // $user = User::create([
            //     'name' => $validator['name'],
            //     'email' => $validator['email'],
            //     'password' => Hash::make($validator['password']),
            // ]);

            // event(new Registered($user));
            // return redirect('/');

            $newUser = new User;
            Log::info(json_encode($request->all()));
            $newUser->name = $request->username;
            $newUser->email = $request->email;
            $newUser->password = $request->password;

            $usernameValidation = User::where('name', $request->username)->first();
            $emailValidation = User::where('email', $request->email)->first();

            if (isset($usernameValidation)) {
                session()->flash('username-error', 'This username is already taken.');
            }

            if (isset($emailValidation)) {
                session()->flash('email-error', 'This email is already taken.');
            }

            if (isset($usernameValidation) || isset($emailValidation)) {
                return view('register');
            }

            $newUser->save();

            return redirect('/login');
        } else {
            return view('register');
        }
    }

    public function login(Request $request)
    {
        if (session()->has('logged') && session()->get('logged') == true) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {

            Log::info($request->username);
            $curUser = User::where('name', $request->username)->first();

            Log::info($curUser);

            if (isset($curUser)) {
                session()->put('logged', true);
                session()->put('userId', $curUser->id);
                return redirect('/');
            } else {
                session()->flash('error', 'Your username or password may be incorrect.');
                return redirect('login');
            }
        } else {
            return view('login');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
