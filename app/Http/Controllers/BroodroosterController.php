<?php 

namespace Brood\Http\Controllers;

use Auth;
use Carbon;
use Redirect;
use Brood\Models\User;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;


class BroodroosterController extends Controller
{
    public function getBroodrooster()
    {
	    if(Auth::check()) {
            
            $user = Auth::user();

            $events = Event::get();

            
            return view('user.broodrooster.index')->with([
                'user' => $user,
                'events' => $events,

            ]);



        }

        return view('user.broodrooster.index');
    }

    public function postSetCycleDays(Request $request)
    {
        
        $user = Auth::user();

        $firstCyclist = $request->input('fist_cyclist');       
        $secondCyclist = $request->input('second_cyclist');       
        
        // dd($firstCyclist, $secondCyclist);

        if ($firstCyclist) {
            //update the user_role to first_cyclist
            $user->setUserToFirstDayCyclist();

        } else {
            //unset the user_role of first_cyclist
            $user->unsetUserAsFirstDayCyclist();
        }

        if ($secondCyclist) {
            // update the user_role to second_cyclist
            $user->setUserToSecondDayCyclist();
            
        } else {
            // unset the user_role of second_cyclist
            $user->unsetUserAsSecondDayCyclist();
          
        }


        return Redirect::back()->with('info_success', 'Je beschikbaarheid is aangepast.');
    } 

    public function postSwapDates(Request $request)
    {
        
        $this->validate($request, [
            'first_event' => 'required',
            'second_event' => 'required',
            ]);

        $first_event_id = $request->input('first_event');
        $second_event_id = $request->input('second_event');

        
        $first_event = Event::find($first_event_id);
        $second_event = Event::find($second_event_id);
               
        $first_event_name = Auth::user()->name;
        $second_event_name = $second_event->name;

        $first_event->name = $second_event_name;
        $second_event->name = $first_event_name;
        
        $first_event->save();
        $second_event->save();

        

        $info = 'info_success';
        $response = 'Diensten zijn geruild.';
        



        return Redirect::back()->with($info, $response);
    }
    
    public function postFillDates(Request $request)
    {
        
        $this->validate($request, [
            'fill' => 'required',
            ]);

        $event_id = $request->input('fill');

        $event = Event::find($event_id);

        $event->name = Auth::user()->name;
        $event->save();

        
        return Redirect::back()->with('info_success', 'Lege dienst gevuld.');
    }
    
}



