<?php

namespace Brood\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * Database table usesed by the model
    * @var string
    */ 
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'send',
        'amount', 
    ];


    public function deleteOrder()
    {
        return $this->delete();
    }
    
    public function changeAmount($amount)
    {
        return $this->update(['amount' => $amount]);
    }

    

}
