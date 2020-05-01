<?php
namespace App;
use App\Division;
use App\Corpse;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  

    public function user()
    {
        return $this->hasMany('App\User');
    }
    

    public function corpse()
    {
        return $this->hasMany('App\Corpse');
    }
}
