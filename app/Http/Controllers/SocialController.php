<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Exception;
use Hash;

class SocialController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication(){
        try{
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id',$googleUser->id)->first();

            if(!$user){
                $userData = User::create([
                    'prenom' => $googleUser->user['given_name'],
                    'nom' => $googleUser->user['family_name'],
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'photos' => $googleUser->avatar,
                    'password' => '123456789',
                    'Role' => 'passager'
                ]);


                if($userData){
                    Auth::login($userData);
                    return redirect()->route('/passager/dashboard');
                }
            }else{
                Auth::login($user);
                return redirect()->route('/passager/dashboard');
            }
        }catch(\Exception $e){
            dd('hhhhhhh : ',$e->getMessage());
        }
    }

    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleFacebookCallback()
    // {
    //     try {

    //         error_log('it passed');
    //         $facebookUser = Socialite::driver('facebook')->user();

    //         $user = User::firstOrCreate(
    //             ['email' => $facebookUser->getEmail()], 
    //             [
    //                 'name' => $facebookUser->getName(),
    //                 'password' => bcrypt('password'), 
    //                 'social_id' => $facebookUser->getId(),
    //                 'social_type' => 'facebook', 
    //             ]
    //         );

    //         Auth::login($user);

    //         return redirect('/dashboard');
    //     } catch (Exception $e) {
    //         error_log($e->getMessage());
    //         return redirect('/login')->withErrors('Erreur lors de la connexion avec Facebook.');
    //     }
    // }
}