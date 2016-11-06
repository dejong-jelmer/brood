<?php 

namespace Brood\Http\Controllers;

use Auth;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    /**
     * postSignup maakt account
     * @param  Request $request [use input van signup]
     * @return create account with user input.
     */
    
    protected function postSignup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|alpha_dash_spaces|max:50',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:5|max:50',
        ]);

        User::create([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'password' =>bcrypt($request->input('password')),
        ]);

        return Redirect::route('home')->with('info_success', 'Je account is aangemaakt, je kunt nu inloggen.');
    }

    public function postSignin(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {

            return Redirect::route('home')->with('info_error', 'het is niet gelukt om in te loggen.');
        }
        
        $user = Auth::user();
        return Redirect::route('home')->with('info_success', "Welkom $user->name.");

    }

    public function getSignout() 
    {
        Auth::logout();
        return Redirect::route('home')->with('info', 'Je bent uitgelogd.');

    }
}




