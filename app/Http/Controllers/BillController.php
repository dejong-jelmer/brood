<?php 

namespace Brood\Http\Controllers;

use Auth;
use Mail;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
	public function getBill()
	{

		return view('user.bread.bill');
	}

	public function getMonthBill(Request $request)
	{
		
		$user = Auth::user();

		if (!$user->hasOrders()) {
			return Redirect::back()->with('info', 'Je hebt nog geen bestellingen gedaan.');
		}

		$year = $request->input('year');
		$month = $request->input('month');

		$bills = $user->getMonthBill($month, $year);
						
		return view('user.bread.monthbill')->with([
			'bills' => $bills,
			'month' => $month,
			'year' => $year,
 		]);
	}

	public function getUserBills()
	{
		$users = User::all();

		return view('admin.user.bills')->with([ 'users' => $users ]);
	}
	
	
	
	
}