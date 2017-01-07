<?php 

namespace Brood\Http\Controllers;

use Auth;
use DB;
use Hash;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function getReset()
	{
		$user = Auth::user();

		$roles = $user->roles()->get();

		return view('user.profile.index')->with([
			'user' => $user,
			'roles' => $roles,
			]);
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

		return Redirect::back()->with('info_success', "Je naam is aangepast naar $user->name");
		
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

		return Redirect::back()->with('info_success', "Je e-mailadres is aangepast naar $user->email");
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

	public function postChangeReminderMail()
	{
		$user = Auth::user();
		$user->setReminderMailStatus();

        return Redirect::back()->with('info_success', 'Je herinneringsmails zijn aangepast.');

	}

	public function postWoonproject(Request $request)
	{
		
		$this->validate($request, [
				'role' => 'required|boolean'
			]);
		
		$user =  Auth::user();
		$success = $user->setWoonproject($request->input('role'));

		if (!$success) {
			$info = 'info_error';
			$response = 'Je woonproject is al opgeven en kan niet aangepast worden.';
		} else {
			$info = 'info_success';
			$response = 'Je woonproject is aangepast.';
		}

        
        return Redirect::back()->with($info, $response);


	}
	

}
