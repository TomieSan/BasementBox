<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  /**
   * Show the form for user registration
   */
  public function showRegister()
  {
    if (Auth::check()) {
      return redirect('/');
    }
    return view('frontend.register');
  }

  /**
   * Store a newly created account in storage.
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required|min:4|max:30|unique:users,username',
      'email'    => 'required|email|min:5|unique:users,email',
      'level'    => '',
      'password' => [
        'required',
        'confirmed',
        Password::min(12)
          ->letters()
          ->mixedCase()
          ->numbers()
          ->symbols()
      ]
    ]);

    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->except('password', 'password_confirmation'))
                       ->withErrors($validator, 'add');
    }

    $validated = $validator->validated();
    $validated['password'] = Hash::make($validated['password']);

    $new_user = new User($validated);
    $new_user->save();
    
    if(!str_contains(url()->previous(), 'admin'))
    {
      Auth::login($new_user);
      return redirect('/');
    }
    else
      return redirect()->back();
  }
  
  /**
   * Show the form for user login
   */
  public function showLogin()
  {
    if (Auth::check()) {
      return redirect('/');
    }
    return view('frontend.login');
  }

  /**
   * Process user login request
   */
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), ['usernameOrEmail' => 'required',
                                                   'password' => 'required']);

    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->except('password'))
                       ->withErrors(['result'=>'The credentials are incorrect. Please check the spelling and try logging in again.']);
    }

    $validated = $validator->validated();

    $user = User::where('username', $validated['usernameOrEmail'])
                ->orWhere('email', $validated['usernameOrEmail'])
                ->first();
    
    if(!Hash::check($validated['password'], $user->password))
    {
      return redirect()->back()
                       ->withInput($request->except('password'))
                       ->withErrors(['result'=>'The credentials are incorrect. Please check the spelling and try logging in again.']);
    }

    Auth::login($user);

    $request->session()->regenerate();
 
    return redirect()->intended('/');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return 'Viewing User # ' . $id;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    return 'Editing User # ' . $id;
  }
}
