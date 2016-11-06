<?php 

namespace Brood\Http\Controllers;


use DB;
use Auth;
use Redirect;
use Brood\Models\User;
use Brood\Models\Bread;
use Brood\Models\Order;
use Illuminate\Http\Request;


class AdminController extends Controller
{
	public function getAdmin()
	{
		$admin = Auth::user();
		
		if (!$admin->isAdmin()) {
			return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
		}
		
		$users = User::with('breads')->get();

		$breads = Bread::with('users')->get();

		return view('admin.index')->with([
			'users' => $users,
			'breads' => $breads,
			]);
	}


	
	
	
}