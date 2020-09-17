<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    //protected $table = 'admins';
    
    public $fillable = [ 'name' ,'created_at' ,'updated_at'  ];
    
    public $hidden = [ 'password', 'remember_token' ];
    
    //public $timestamps = false;
    
    /*****   Start Relation   *****/
    /*****   /End Relation   *****/

}
