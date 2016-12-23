<?php 

namespace Brood\Http\Controllers;


use DB;
use Auth;
use Carbon;
use Redirect;
use Brood\Models\User;
use Brood\Models\Bread;
use Brood\Models\Order;
use Brood\Models\Message;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;


class AdminController extends Controller
{
	public function getAdmin()
	{
		$admin = Auth::user();
		
		if (!$admin->isAdmin()) {
			return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
		}
		
		// Get user with orders
		$users = User::with('breads')->get();

		// Get al (by users) ordered breads 
		$breads = Bread::with('users')->get();

		// Messages
        $messages = Message::where('expires', '>=', Carbon::today())->get();

		return view('admin.index')->with([
			'users' => $users,
			'breads' => $breads,
            'messages' => $messages,
			]);
	}

	public function getAdminBroodrooster()
	{
		$admin = Auth::user();
		
		if (!$admin->isAdmin()) {
			return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
		}
		
		$events = Event::get();
		
		$users = User::with('roles')->get();
		
        if(!$events->count()) {
            return view('admin.broodrooster.index')->with(['users' => $users]);
        }
        
        
        return view('admin.broodrooster.index')->with([
            'events' => $events,    
            'users' => $users,    
            ]);

	}

	public function postAdminBroodrooster(Request $request)
	{
		$admin = Auth::user();
		
		if (!$admin->isAdmin()) {
			return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
		}
		$this->validate($request, [
			'cyclist' => 'alpha_dash|required',
			'date' => 'date|required',
		]);


		$name = $request->input('cyclist');
		
		$date = strtotime($request->input('date'));
		$y = date('Y', $date);
		$m = date('m', $date);
		$d = date('d', $date);

		$event = new Event;

        $event->name = $name;
        $event->startDate = Carbon\Carbon::createFromDate($y, $m, $d, 'UTC');
        $event->endDate = Carbon\Carbon::createFromDate($y, $m, $d, 'UTC');

        $event->save();


        return Redirect::back()->with('info_success', 'Dienst ingevoerd.');
	}

	public function postRemoveFromBroodrooster(Request $request)
	{
		$admin = Auth::user();
		
		if (!$admin->isAdmin()) {
			return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
		}

		// dd($request->input('id'));

		if (!$request->input('id')) {

			$info = 'info_error';
			$response = 'Het is niet gelukt de dienst aan te passsen.';

		} else {
			$input = explode(':', $request->input('id'));
				$event = Event::find($input[0]);
			
				if(!$input[1]) {
					$event->name = '';
					$event->save();
					$info = 'info_success';
					$response = 'Dienst leeg gemaakt.';
				} else {
					$event->delete();
					$info = 'info_success';
					$response = 'Dienst verwijderd.';
				}
			

		} 

        return Redirect::back()->with($info, $response);

	}
	
	
	
	
	
	
}