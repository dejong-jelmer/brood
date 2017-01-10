<?php 

namespace Brood\Http\Controllers;


use Auth;
use Mail;
use Storage;
use Redirect;
use Helper;
use Brood\Models\User;
use Brood\Models\Bread;
use Brood\Models\Order;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class MailController extends Controller
{

 

    // load a mail with the order content and send mail
    public function mailOrder()
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }
        // Most recent send order.
        $mostRecentOrder = Order::orderBy('updated_at', 'desc')->where('send', true)->first();
  
        $breads = Bread::with('users')->get();
        
        // Get email for next cyclist from google calendar and User model
        $events = Event::get();
        $first_event = $events->first();
        $first_event_name = $first_event->name;
        $next_cyclist_email = User::select('email')->where('name', $first_event_name)->first();
        
        if ($next_cyclist_email) {
            $next_cyclist_email = $next_cyclist_email->email;
        } else {
            $next_cyclist_email = 'vokolent@gmail.com';
        }

        
        $data = [
            'from' => 'mail@brood.iewan.nl',
            'name' => $admin->name,
            'to' => 'bakkerarend@kpnplanet.nl',
            'cc_1' => 'broodvanbakkerarend@gmail.com',
            'cc_2' => 'theabouwhuis@kpnmail.nl',
            'cc_3' => 'janvdveen54@gmail.com',
            'cc_4' => $admin->email,
            'cyclist' => $next_cyclist_email,
            'breads' => $breads,
            'mostRecentOrder' => $mostRecentOrder,
            'nextDeliveryDay' => 'Bestelling Iewan voor aanstaande ' . Helper::nextDeliveryDay($mostRecentOrder->updated_at),
            ];


        Mail::send('admin.email.order', $data, function($mail) use ($data) {
            $mail->from($data['from']);
            $mail->to($data['to']);
            $mail->cc($data['cc_1']);
            $mail->cc($data['cc_2']);
            $mail->cc($data['cc_3']);
            $mail->cc($data['cc_4']);
            $mail->cc($data['cyclist']);
            
            $mail->subject($data['nextDeliveryDay']);
        });

        $date = date("Y-m-d");

        foreach ($breads as $bread) {
            
            foreach($bread->users as $user){
                if(!$user->pivot->send) {
                    $amountSum[] = $user->pivot->amount;
                }
            }

            if(isset($amountSum)) {
                $order = [ 
                    'amount' => array_sum($amountSum),
                    'bread' => Bread::getBreadName($user->pivot->bread_id)->bread,
                    ];
                
                unset($amountSum);
    
            Storage::disk('orders')->append("order-$date.txt", $order['amount'].' x '.$order['bread'].',' );
            }
        }
        
        Order::where('send', false)->update([
            'send' => true,
            ]);
        

        return Redirect::back()->with('info_success', 'De bestellingsmail is succesvol verstuurd.');
    }

    // Sends mail with the month bill for each user.
    public function mailUserBills(Request $request)
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }

        // if input has only one user, make array (with one item) for 'foreach-loop'
        if ($request->input('user_id')) {

            $users = array(User::findOrFail($request->input('user_id')));
    
        } else { 
            $users = User::all();
        }

        // check if a specific month/year is selected and if not send bills of previous month. 
        if (!$request->input('month') && !$request->input('year')) {
                $year = date('Y');
                $month = date('m') > 1 ? date('m') - 1 : '12';
            } else {
                $year =  $request->input('year');
                $month =  $request->input('month');
            }

        foreach ($users as $user) { 

            $bills = $user->getMonthBill($month, $year);

            $data = [
                'from' => 'mail@brood.iewan.nl',
                'userEmail' => $user->email,
                'userName' => $user->name,
                'financial_admin' => 'vokolent@gmail.com',
                'bills' => $bills,
                'year' => $year,
                'month' => $month,
            ];

            
            Mail::send('admin.email.userbills', $data, function($mail) use ($data) {
                $mail->from($data['from']);
                $mail->to($data['userEmail']);
                $mail->cc($data['financial_admin']);
                
                $mail->subject('maandrekening');
            });

            
            unset($data);
            unset($bills);

        }


        return Redirect::back()->with('info_success', 'De maandrekening(en) is/zijn verstuurd.');
    }

      

    
}
