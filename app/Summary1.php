<?php
namespace App; 
use App\Corpse;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Summary extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
     public function user()
    {
        return $this->hasMany('App\User');
    }
    

    public function corpse()
    {
        return $this->belongsTo('App\Corpse');
    }
}
