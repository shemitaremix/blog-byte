<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginSocialiteController extends Controller
{

    //login con facebook
    public function login(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        try {
            $user = Socialite::driver('facebook')->user();
            $encontradoUsuario = User::where('red_social_id', $user->id)->first();
            if ($encontradoUsuario) {
                Auth::login($encontradoUsuario);
                Log::channel('info')->info('Usuario logueado '.$user->email);
                return redirect()->route('index');
            }else{
                $nuevoUsuario = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'red_social_id' => $user->id,
                    'password' => bcrypt('12345678'),
                ]);
                Log::channel('info')->info('Usuario registrado '.$user->email);
                Auth::login($nuevoUsuario);
                return redirect()->route('index');
            }
            
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al loguear usuario: '.$e->getMessage());
            return redirect()->route('login');
        }
        
    }

    //login con github

    public function githubLogin(){
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback(){
        try {
            $user = Socialite::driver('github')->user();
            $encontradoUsuario = User::where('red_social_id', $user->id)->first();
            if ($encontradoUsuario) {
                Auth::login($encontradoUsuario);
                Log::channel('info')->info('Usuario logueado '.$user->email);
                return redirect()->route('index');
            }else{
                $nuevoUsuario = User::create([
                    'name' => $user->nickname,
                    'email' => $user->email,
                    'red_social_id' => $user->id,
                    'password' => bcrypt('12345678'),
                ]);
                Log::channel('info')->info('Usuario registrado '.$user->email);
                Auth::login($nuevoUsuario);
                return redirect()->route('index');
            }
            
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al loguear usuario: '.$e->getMessage());
            return redirect()->route('login');
        }
    }

    //login con google

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        try {
            $user = Socialite::driver('google')->user();
            $encontradoUsuario = User::where('red_social_id', $user->id)->first();
            if ($encontradoUsuario) {
                Auth::login($encontradoUsuario);
                Log::channel('info')->info('Usuario logueado '.$user->email);
                return redirect()->route('index');
            }else{
                $nuevoUsuario = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'red_social_id' => $user->id,
                    'password' => bcrypt('12345678'),
                ]);
                Log::channel('info')->info('Usuario registrado '.$user->email);
                Auth::login($nuevoUsuario);
                return redirect()->route('index');
            }
            
        } catch (\Exception $e) {
            Log::channel('error')->error('Error al loguear usuario: '.$e->getMessage());
            return redirect()->route('login');
        }
    }

}
