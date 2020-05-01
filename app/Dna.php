<?php

namespace App;
 
use App\Corpse; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dna extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
   

    public function corpse()
    {
        return $this->belongsTo('App\Corpse');
    }
}
