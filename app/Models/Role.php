<?php

namespace Brood\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
    * Database table usesed by the model
    * @var string
    */ 
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roles', 
    ];

    // belongs to Users -> relation
    public function users() 
    {
    	return $this->belongsToMany('Brood\Models\User')
            ->withPivot('active')
            ->withTimestamps();
    }

    
   
}
