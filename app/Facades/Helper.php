<?php

Namespace Brood\Facades;

use DB;
use Brood\Models\Order;

class Helper
{
    /**
    *
    *  
    * @var string.
    */
    // make month number to month name (dutch).

    public static function monthNumberToMonthName($month)
    {
          $monthName = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');

          return $monthName[$month - 1];

    }

    /** 
    *   calculates the total price of an order -> amount of breads x the single item price
    * 
    * @var string
    * @return 
    */
    
    public static function totalPrice($amount, $price)
    {   
        return sprintf("%.2f", $price * $amount);
    }

    /** 
    * takes the totalPrice per order and calculates the total month price(month bill).
    * @var string
    *
    * @return
    */

    public static function totalMonthPrice($totalPrice)
    {
        return sprintf("%.2f", array_sum($totalPrice));
    }

    /** 
    * Checks if Order was send returns TRUE if there are unsend orders.
    * 
    *
    * @return Boolean
    */
    public static function newOrders()
    {
        return (bool) Order::where('send', false)->count();
    }

    public static function nextDeliveryDay($date)
    {
        // day of the week last order was send
        $date_to_timestamp = strtotime($date);
        $date_day_of_the_week = date( "w", $date_to_timestamp);

        // current day of the week 
        $current_timestamp = strtotime("now");
        $current_day_of_the_week = date( "w", $current_timestamp);
           
        if ($date_day_of_the_week <= 3) {
            if ( $date_day_of_the_week > 5 || $date_day_of_the_week <= 1 ) {
                $next_delivery_day = "vrijdag.";
            } else { 
                $next_delivery_day = "dinsdag."; 
            }
            
        } elseif ($date_day_of_the_week > 3) {
            if ($current_day_of_the_week >= 1 && $current_day_of_the_week < 4) {
                
                $next_delivery_day = 'vrijdag.';
             
            } else { $next_delivery_day = 'dinsdag.'; }
        }
        
        return $next_delivery_day;
       
    }

           

}