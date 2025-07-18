<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller{


public function register(Request $request){
    $incomingFields=$request->validate([
         'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:20']
    ]);
     $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    return 'Controller';

}

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            "loginname" => "required",
            "loginpassword" => "required",
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors(['loginname' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
    
    public function showProfile(){
        $user=Auth::user();
        return view('profile',compact('user'));
    }
    public function updateProfile(Request $request){
        $user=Auth::user();

        $validated=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user->name=$validated['name'];
        $user->email=$validated['email'];
        if(!empty($validated['password'])){
            $user->password=Hash::make($validated['password']);
        }
        $user->save();
        return redirect('/profile');
    
   $validated=$request->validate([
        'name'=>'required',
        'email'=>'required',
        'old_password'=>'nullable|required_with:password|current_password',
        'password'=>'required',
    ]);
    $user=auth()->user();
    $user->name=$request->name;
    $user->email=$request->email;
    if($request->filled('password')){
        $user->password=Hash::make($request->password);
    }
    $user->save();



}

}