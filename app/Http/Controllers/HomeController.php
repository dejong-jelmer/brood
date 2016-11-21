<?php 

namespace Brood\Http\Controllers;

use Auth;
use Redirect;
use Brood\Models\User;
use Brood\Models\Order;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;


class HomeController extends Controller
{
    public function getIndex()
    {

        if (Auth::user()) {
            
            $mostRecentOrder = Order::orderBy('updated_at', 'desc')->where('send', true)->first();
            
            $orders = Auth::user()->unsendOrders();
            
            $events = Event::get(); 
            $firstEvent = $events->first();    
                

                return view('home')->with([
                    'orders' => $orders,
                    'mostRecentOrder' => $mostRecentOrder,
                    'firstEvent' => $firstEvent,
                    ]);
            

        }

        return view('home');
    }

    public function redirect()
    {
        return redirect('/');
    }


    public function postRemoveUnsendOrder(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            ]);
        
        $order = Order::findOrFail($request->input('id'));  
        
        $deleteOrder = $order->deleteOrder();

        if($deleteOrder) {
            $info = 'info_success';
            $response = 'Je bestelling is verwijderd.';
        } else {
            $info = 'info_error';
            $response = 'Het is niet gelukt je bestelling te verwijderen.';
        }

        return Redirect::back()->with($info, $response);
    }
    
}
    
?>
