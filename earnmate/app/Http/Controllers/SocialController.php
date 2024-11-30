<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Admin;
use App\Models\Social;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public  function generateUniqueCode()
    {
    
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
    
        $code = '';
    
        while (strlen($code) < 8) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
    
        if (User::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
    
        return $code;
    
    }
    public function redirect(string $provier)
    {
        return Socialite::driver($provier)->redirect();
    }
    public function callback(string $provider) 
     {
        $SocialUser = Socialite::driver( $provider)->stateless()->user();
        $user = User::where('email',$SocialUser->getEmail())->first();
        $name = $SocialUser->getNickname() ?? $SocialUser->getName();
       
        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $SocialUser->getEmail(),
                'password' => Hash::make('12345678'),
                'code' => $this->generateUniqueCode(),
                'balance' => 00.00
            ]);
            Social::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $SocialUser->getId(),
                'provider_token' => $SocialUser->token,
                'provider_refresh_token' => $SocialUser->refreshToken,
                'provider_avatar' => $SocialUser->getAvatar(),
            ]);
            Auth::login($user,true);
            return redirect()->route('dashboard');
        }
        $socials = Social::where('provider',$provider)
        ->where('user_id',$user->id)
        ->first();
        if (!$socials) {
            Social::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_id' => $SocialUser->getId(),
                'provider_token' => $SocialUser->token,
                'provider_refresh_token' => $SocialUser->refreshToken,
                'provider_avatar' => $SocialUser->getAvatar(),
            ]);
        }   

        Auth::login($user,true);
        if (Admin::where('user_id',Auth::user()->id)->exists()) {
            return redirect()->intended(route('admin.dashboard',absolute:false));
        }
        return redirect()->route('dashboard');
    }
}
