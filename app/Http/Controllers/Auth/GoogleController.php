<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordGeneratedMail;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Busca si el usuario ya existe en la base de datos
        $user = User::where('google_id', $googleUser->getId())->first();


        if (!$user) {

            $password = Str::random(10);
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make($password),
                'activo' => 1,
                'google_id' => $googleUser->getId(),
                /* 'avatar' => $googleUser->getAvatar(),*/
            ]);
            Mail::to($user->email)->send(new PasswordGeneratedMail($user, $password));
            
        }

        $userRol = Role::where('name', 'cliente')->first();
        if ($userRol) {
            $user->assignRole($userRol);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
