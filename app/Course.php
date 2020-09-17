<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /*------------------------------*/
    //protected $table = 'courses';
    public $fillable = [ 'name','add_by' ];
    /*------------------------------*/
    
    /*------------------------------*/
    /*****   ***************   *****/
    /*****   Start Accessors   *****/
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
    /*****   /End  Accessors   *****/
    /*****   ***************   *****/
    /*------------------------------*/
    
    /*------------------------------*/
    /*****   ***************   *****/
    /*****   Start Mutators   *****/
    /*****   /End  Mutators   *****/
    /*****   ***************   *****/
    /*------------------------------*/
    
    /*------------------------------*/
    /*****   ***************   *****/
    /*****   Start Local scope   *****/
    public function scopeSelection($query)
    {
        return $query->select('id', 'name','created_at','updated_at');
    }

    /*****   /End  Local scope   *****/
    /*****   ***************   *****/
    
    /*------------------------------*/
    /*****   ***************   *****/
    /*****   Start Relation   *****/

    public function users()
    {
        return $this->belongsToMany('App\User');
    }    
    /*****   /End Relation   *****/
    /*****   ***************   *****/
    /*------------------------------*/

}
