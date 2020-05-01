<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Investigator;
class Rank extends Model
{


  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  



    public function investigator()
    {
        return $this->hasMany('App\Investigator');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
