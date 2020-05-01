<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Division;
class Parish extends Model
{


  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  


    public function division()
    {
        return $this->hasMany('App\Division');
    }
}
