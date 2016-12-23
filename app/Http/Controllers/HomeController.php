<?php 

namespace Brood\Http\Controllers;

use Auth;
use Redirect;
use Carbon;
use Brood\Models\User;
use Brood\Models\Order;
use Brood\Models\Message;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;


class HomeController extends Controller
{
    public function getIndex()
    {

        if (Auth::user()) {
            
            // Most recent send order.
            $mostRecentOrder = Order::orderBy('updated_at', 'desc')->where('send', true)->first();
            
            // All unsend user orders.
            $orders = Auth::user()->unsendOrders();
            
            // Next event
            $events = Event::get(); 
            $firstEvent = $events->first();  

            // Messages
            $messages = Message::where('expires', '>=', Carbon::today())->get();

                return view('home')->with([
                    'orders' => $orders,
                    'mostRecentOrder' => $mostRecentOrder,
                    'firstEvent' => $firstEvent,
                    'messages' => $messages,
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
