<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Comment extends Model
{


  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

 

    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
}
