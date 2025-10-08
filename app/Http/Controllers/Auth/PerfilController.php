<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;


class PerfilController extends Controller
{
    public function edit()
    {
        $registro = Auth::user();
        return view('auth.perfil', compact('registro'));
    }

    public function update(UserRequest $request)
    {
        $registro = Auth::user();
        $registro->name = $request->name;
        $registro->email = $request->email;
        if ($request->filled('password')) {
            $registro->password = Hash::make($request->password);
        }
        $registro->save();
        return redirect()->route('perfil.edit')->with('mensaje', 'Datos Actualizados');
    }
}
