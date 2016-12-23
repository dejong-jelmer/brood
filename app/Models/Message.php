<?php

namespace Brood\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
    * Database table usesed by the model
    * @var string
    */ 
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'message',
        'expires',
    ];
}
