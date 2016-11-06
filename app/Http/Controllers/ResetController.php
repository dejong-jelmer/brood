<?php 

namespace Brood\Http\Controllers;

use Auth;
use DB;
use Hash;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;

class ResetController extends Controller
{
	public function getReset()
	{
		return view('user.profile.index');
	}

	public function postResetUsername(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|alpha_dash_spaces|unique:users|max:50',
			]);

		Auth::user()->update([
			'name' => $request->input('name'),
			]);

		$user = Auth::user();

		return Redirect::route('home')->with('info_success', "Je naam is aangepast naar $user->name");
		
	}

	public function postResetEmail(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|unique:users|email|max:50',
			]);

		Auth::user()->update([
			'email' => $request->input('email'),
			]);

		$user = Auth::user();

		return Redirect::route('home')->with('info_success', "Je e-mailadres is aangepast naar $user->email");
	}


	public function postResetPassword(Request $request)
	{

		$this->validate($request, [
			'current_password' => 'required',
			'password' => 'required|confirmed',
			]);
	
		$user = Auth::user();

		$current_password =  $request->input('current_password');

		if (!Hash::check($current_password, $user->password)) {
        	return Redirect::back()->with('info_error', 'Het is niet gelukt je wachtwoord aan te passen.');
		}

		Auth::user()->update([
				'password' => bcrypt($request->input('password')),
			]);

		DB::table('password_resets')->insert([
				'email' => $user->email,
				'token' => $request->input('_token'),
			]);
    	
		Auth::logout();
        return Redirect::route('home')->with('info_success', 'Je wachtwoord is aangepast.');
	}


}
