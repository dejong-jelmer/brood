<?php

namespace Brood\Models;

use Illuminate\Database\Eloquent\Model;


class Bread extends Model
{
    
    /**
    * Database table usesed by the model
    * @var string
    */ 
    protected $table = 'breads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bread', 
        'price',
        'deleted',
    ];

    // Breads belongsToMany orders -> relation
    public function users()
    {
        return $this->belongsToMany('Brood\Models\User', 'orders')
            ->withPivot('id', 'amount', 'send')
            ->withTimestamps();
    }
    
    
    public function scopegetBreadName($query, $bread_id) 
    {
        return $query->where('id', $bread_id)->first();
    }

    public function deleteBread()
    {
        return $this->update(['deleted' => true]);
    }
    

    
}


