<?php 

namespace Brood\Http\Controllers;

use DB;
use Auth;
use Storage;
use Redirect;
use Brood\Models\Bread; 
use Brood\Models\Order; 
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function getOrder()
    {
        $user = Auth::user();

        if($user->isDeactivated()) {
            return Redirect::route('home')->with('info_error', 'Je account is gedeactiveerd, je kunt geen bestellingen meer plaatsen.');
        }
        
        $breads = Bread::where('deleted', false)->get();

        return view('user.bread.order')->with(['breads' => $breads]);
    }

    public function postOrder(Request $request)
    {
        $user = Auth::user();

        if($user->isDeactivated()) {
            return Redirect::route('home')->with('info_error', 'Je account is gedeactiveerd, je kunt geen bestellingen (meer) plaatsen.');
        }

        $breads =  array($request->input('bread'));

        $i = 0;
        foreach ($breads as $id) {
            
            // checks if inputfield 'brood' has value, if not redirect back.
            if(empty($request->bread[$i])) {
                return Redirect::back()->with('info_error', 'Je bent vergeten een brood op te geven.');
            }

            // checks if inputfield 'aantal' has value, if not redirect back.
            if(empty($request->amount[$i])) {
                return Redirect::back()->with('info_error', 'Je bent vergeten het aantal op te geven.');
            }
            
            $amount = $request->amount[$i];
            
            $user->breadOrders($id, $amount);

            $i++;

        }

        return Redirect::route('home')->with('info_success', 'Je bestelling is geplaatst.');
        
    }

    public function getRecentOrders()
    {
        $last_send_order = Order::where('send', true)->max('updated_at');
        $d = strtotime($last_send_order); 
        $date = date("Y-m-d", $d);
        $exists = Storage::disk('orders')->exists("order-$date.txt");

        if(!$last_send_order || !$exists) {

            return view('user.recentorders');
        }
                
        $file = Storage::disk('orders')->get("order-$date.txt");
        $orders = explode(',', $file);
        
        return view('user.recentorders')->with(['orders' => $orders]);

    }
    
    public function getChangeOrder()
    {
        return view('admin.user.changeorder');
    }

    public function postChangeOrder(Request $request)
    {
        
        $this->validate($request, [
                'remove' => 'boolean',
                'amount' => 'integer|max:25',
                'id' => 'integer', 
            ]);

        if ($request->input('remove') && !$request->input('amount')) {
            
            $order = Order::findOrFail($request->input('id'));
            
            $deleted = $order->deleteOrder();
            
            if($deleted) {
                $info = 'info_success';
                $response = 'De bestelling is verwijderd.' ;
            } else {
                $info = 'info_error';
                $response = 'Het verwijderen is niet gelukt.';
            }
    
        }

        if (!$request->input('remove') && $request->input('amount')) {
            
            $order = Order::findOrFail($request->input('id'));
            $amount = $request->input('amount');

            $changed = $order->changeAmount($amount);
            
            if($changed) {
                $info = 'info_success';
                $response = 'Het aantal van de bestelling is aangepast.';
            } else {
                $info = 'info_error';
                $response = 'Het aantal aanpassen is niet gelukt.';
            }

        }
        
        if(empty($info) && empty($response)) {
            $info = 'info_error';
            $response = 'Oeps, er is iets misgegaan.'; 
        }

        return Redirect::back()->with($info, $response);
    }


    

}

?>
