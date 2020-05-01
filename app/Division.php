<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Station;
use App\Parish;
class Division extends Model
{

    


  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  


    public function station()
    {
        return $this->hasMany('App\Station');
    }




    public function parish()
    {
        return $this->belongsTo('App\Parish');
    }


}
