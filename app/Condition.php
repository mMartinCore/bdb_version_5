<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Corpse;
class Condition extends Model
{     
  
  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  


    public function corpse()
    {
        return $this->hasMany('App\Corpse');
    }


}
