<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfoPill;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class ProvidersController extends Controller
{
    public function loginUsingFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackFromFacebook() {
        try {
                $user = Socialite::driver('facebook')->stateless()->user();
                $finduser = User::where('email', $user->id."@facebook.com")->first();
            if ($finduser) {
                backpack_auth()->login($finduser);
                return redirect('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->id."@facebook.com",
                    'facebook_id' => $user->id,
                    'serial_num' => strtoupper(Str::random(10)),
                    'terms_agreed' => 1,
                    'password' => encrypt('N2h9A9e8D9m0A5a6')
                ]);
                event(new Registered($newUser));
                $ship_info = new UserInfoPill();
                $ship_info->user_id = $newUser->id;
                $ship_info->save();
                
                $newUser->otp = rand(1111, 9999);
                $newUser->save();
                backpack_auth()->login($newUser);
                

                // \General::sendOTP($user->phone, $user->otp);
                return redirect(route('personal.edit'))->with(['success' => 'تم إنشاء الحساب بنجاح .. يرجي استكمال بيانات الحساب حتي تتمتع بأفضل تجربة في الموقع ']);

            }

        } catch (   Exception $e) {
            return redirect()->back()->with(['error' => __('messages.empty.track')]);
        }
    }
    public function loginUsingGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {

        try {

            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('email', $user->id."@gmail.com")->first();
            if ($finduser) {
                backpack_auth()->login($finduser);
                return redirect('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->id."@gmail.com",
                    'serial_num' => strtoupper(Str::random(10)),
                    'google_id' => $user->id,
                    'terms_agreed' => 1,
                    'password' => encrypt('N2h9A9e8D9m0A5a6')
                ]);
                event(new Registered($newUser));
                $ship_info = new UserInfoPill();
                $ship_info->user_id = $newUser->id;
                $ship_info->save();
                backpack_auth()->login($newUser);
                
                $newUser->otp = rand(1111, 9999);
                $newUser->save();
                
                return redirect(route('personal.edit'))->with(['success' => 'تم إنشاء الحساب بنجاح .. يرجي استكمال بيانات الحساب حتي تتمتع بأفضل تجربة في الموقع ']);
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['error' => __('messages.empty.track')]);
        }

    }
}
