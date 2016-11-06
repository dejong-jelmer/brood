<?php

namespace Brood\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'password',
        'name',
        'deactivated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // User belongsToMany breads -> relation.
    public function scopebreads()
    {
        return $this->belongsToMany('Brood\Models\Bread', 'orders')
            ->withPivot('id', 'amount', 'send')
            ->withTimestamps();
    }
    
    // User belongsToMany roles -> relation.
    public function roles() 
    {
        return $this->belongsToMany('Brood\Models\Role')
            ->withPivot('active')
            ->withTimestamps();
    }

    public function isDeactivated()
    {
        return (bool) $this->where('deactivated', true)->count();
    }  

    // updates the orders pivot table.
    public function breadOrders($id, $amount) 
    {
        if(!$this->isDeactivated()) {
            $this->breads()->attach($id, [
                'amount' => $amount,
            ]);
        } else {
            return false;
        }
    }

    public function getMonthBill($month, $year)
    {
        return $this->breads()
        ->whereMonth('orders.updated_at', $month)
        ->whereYear('orders.updated_at', $year)
        ->get();

    }
    
    
    public function hasOrders()
    {
        return (bool) $this->breads()->count();
    }

    public function unsendOrders()
    {
        return $this->breads()->wherePivot('send', false)->get();
    }

    public function hasUnsendOrders($user_id)
    {
        return (bool) $this->breads()->wherePivot('user_id', $user_id)->wherePivot('send', false)->count();
    }


    public function isAdmin()
    {
        return (bool) $this->roles()->wherePivot('active', true)->count();
    }
    
    
    public function getUserEmail($user_id)
    {
        return $emial = $this->where('id', $user_id)->first(); 
    }
    
    public function hasAdminRole()
    {
        return (bool) $this->roles()->wherePivot('role_id', '1')->count();
    }

    
    public function giveAdminRights()
    {
        if ($this->hasAdminRole()) {
        
            return $this->roles()->first()->pivot->update(['active' => true]);
        
        } else {
        
            return $this->roles()->attach('1',['active' => true]);
            
        }
    }

    public function takeAdminRights()
    {
       return $this->roles()->first()->pivot->update(['active' => false]);
    }
   
    public function deactivate()
    {
        return $this->update(['deactivated' => true]);
    }

    public function reactivate()
    {
        return $this->update(['deactivated' => false]);
    }
        
    
    
}
