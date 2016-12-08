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
    public function breads()
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
        return (bool) $this->deactivated;
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

    // String. monthbill on given month and year
    public function getMonthBill($month, $year)
    {
        return $this->breads()
        ->whereMonth('orders.updated_at', $month)
        ->whereYear('orders.updated_at', $year)
        ->get();

    }
    
    // Boolean. Check if user has orders
    public function hasOrders()
    {
        return (bool) $this->breads()->count();
    }

    // String. return all unsend orders
    public function unsendOrders()
    {
        return $this->breads()->wherePivot('send', false)->get();
    }

    // Boolean. Check if given user has unsend orders
    public function hasUnsendOrders($user_id)
    {
        return (bool) $this->breads()->wherePivot('user_id', $user_id)->wherePivot('send', false)->count();
    }

    // Boolean. Check if user has admin privileges
    public function isAdmin()
    {
        return (bool) $this->roles()->wherePivot('role_id', '1')->wherePivot('active', true)->count();
    }
    
    // String. Return the users row for email adress
    public function getUserEmail($user_id)
    {
        return $emial = $this->where('id', $user_id)->first(); 
    }
    
    // Boolean. Check if a given user has admin privileges
    public function hasAdminRole()
    {
        return (bool) $this->roles()->wherePivot('role_id', '1')->count();
    }

    
    // Give Admin privileges to user
    public function giveAdminRights()
    {
        if (!$this->hasAdminRole()) {
                
            return $this->roles()->attach('1',['active' => true]);

        } else {
        
            return $this->roles()->wherePivot('role_id', '1')->first()->pivot->update(['active' => true]);
        }
    }

    // Take Admin privileges from user
    public function takeAdminRights()
    {
       return $this->roles()->wherePivot('role_id', '1')->first()->pivot->update(['active' => false]);
    }
    
    // deactivete user account
    public function deactivate()
    {
        return $this->update(['deactivated' => true]);
    }

    // reactivate user account
    public function reactivate()
    {
        return $this->update(['deactivated' => false]);
    }
    
    // get all first day Cyclist
    public function getAllFirstCyclist()
    {
        return $this->roles()->wherePivot('role_id', '2')->wherePivot('active' , true)->get();
    }

    // get all second day Cyclist
    public function getAllSecondCyclist()
    {
        return $this->roles()->wherePivot('role_id', '3')->wherePivot('active' , true)->get();
    }

  

    // Check if  user is first day cyclist
    public function isFirstCyclist()
    {
        return (bool) $this->getAllFirstCyclist()->count();
    }

    // Check if user is seccond day cyclist
    public function isSecondCyclist()
    {
        return (bool) $this->getAllSecondCyclist()->count();
    }

    public function isCyclist()
    {
        if($this->isFirstCyclist() || $this->isSecondCyclist()) {  
            return true;
        } else {
            return false;

        }
        
    }
    
    // update the user_role to first_cyclist
    public function setUserToFirstDayCyclist()
    {
        if(!$this->isFirstCyclist()) {

            return $this->roles()->attach('2', ['active' => true ]);

        } else {

            return $this->roles()->wherePivot('role_id', '2')->first()->pivot->update(['active' => true]);
        }
    }
    
    // unset the user_role of first_cyclist
    public function unsetUserAsFirstDayCyclist()
    {
        return $this->roles()->detach('2');
    }

    // update the user_role to second_cyclist
    public function setUserToSecondDayCyclist()
    {
        if(!$this->isSecondCyclist()) {

            return $this->roles()->attach('3', ['active' => true ]);
            
        } else {

            return $this->roles()->wherePivot('role_id', '3')->first()->pivot->update(['active' => true]);
        }
    }

    // unset the user_role of second_cyclist
    public function unsetUserAsSecondDayCyclist()
    {
        return $this->roles()->detach('3');
    }

    
    
}
