<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('auth.registro');
    }

    public function registrar(UserRequest $request){

        $user=User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> Hash::make($request->input('password')),
            'activo'=> 1,
        ]);
        
        $userRol=Role::where('name','cliente')->first();
        if ($userRol) {
            $user->assignRole($userRol);
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with('mensaje','Registro Exitoso. Bienvenido!');
    }
    
}
