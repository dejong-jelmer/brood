<?php 

namespace Brood\Http\Controllers;


use Auth;
use Mail;
use Storage;
use Redirect;
use Brood\Models\User;
use Brood\Models\Bread;
use Brood\Models\Order;
use Illuminate\Http\Request;

class MailController extends Controller
{

 

    // load a mail with the order content and send mail
    public function mailOrder()
    {
        $admin = Auth::user();
        
        if (!$admin->isAdmin()) {
            return Redirect::back()->with('info', 'Je hebt geen beheerdersrechten.');
        }
  
        $breads = Bread::with('users')->get();
        
        $data = [
            'from' => $admin->email,
            'name' => $admin->name,
            'breads' => $breads,
            ];


        Mail::send('admin.email.order', $data, function($mail) use ($data) {
            $mail->from($data['from']);
            $mail->to('test@mail.com');
            
            $mail->subject('bestelling Iewan');
        });

        $date = date("Y-m-d");

        foreach ($breads as $bread) {
            
            foreach($bread->users as $user){
                $amountSum[] = $user->pivot->amount;
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

        foreach ($users as $user) {
            // check if a specific month/year is selected and if not send bills of previous month. 
            if (!$request->input('month') && !$request->input('year')) {
                $year = date('Y');
                $month = date('m') > 1 ? date('m') - 1 : '12';
            } else {
                $year =  $request->input('year');
                $month =  $request->input('month');
            }

            $bills = $user->getMonthBill($month, $year);

            $data = [
                'adminEmail' => $admin->email,
                'userEmail' => $user->email,
                'bills' => $bills,
                'year' => $year,
                'month' => $month,
            ];

            Mail::send('admin.email.userbills', $data, function($mail) use ($data) {
                $mail->from($data['adminEmail']);
                $mail->to($data['userEmail']);
                
                $mail->subject('maandrekening');
            });
        }

        return Redirect::back()->with('info_success', 'De maandrekening(en) is/zijn verstuurd.');
    }
}
