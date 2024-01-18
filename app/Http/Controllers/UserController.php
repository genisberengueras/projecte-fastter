<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

    }
    public function store(Request $req)
    {
        $credential=$req->validate([
            'name'=>'required|unique:users',
            'email'=>'required',
            'password'=>'required|confirmed',
        ]);

        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);

        return redirect()->route('home');
    }
    public function update($id)
    {

    }
    public function destroy($id)
    {

    }
    public function show($id)
    {

    }
    public function login(){
        return view('login');
    }
    public function attemptLogin(Request $req){
        $credential=$req->validate([
           'name'=>'required',
           'password'=>'required',
        ]);

        if(Auth::attempt($credential)){
            $req->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
           'name'=>'Invalid Credentials'
        ]);
    }
    public function create(){
        return view('register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
