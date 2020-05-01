<?php

namespace App;
use Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use App\Corpse;
use App\Comment;
use App\Rank;
use App\Station;
use App\Message;
use  App\Task;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable,HasRoles, HasApiTokens;
    


  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  


    protected $guard_name='web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'rank_id',
        'regNo',
        'station_id',
        'division_id',
        'user_id',
        'modified_by',
        'email',
        'email_verified_at',
        'password',
        'status',
        'remember_token'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    }




    public function feedback()
    {
        return $this->hasMany('App\Comment');
    }





    // public function setPasswordAttribute($password)
    //  {

    //    $this->attributes['password'] = bcrypt($password);
    //  }

     public function corpse()
     {
        return $this->hasMany('App\Corpse');
     }
     public function rank()
     {
         return $this->belongsTo('App\Rank');
     }

     public function station()
     {
         return $this->belongsTo('App\Station');
     }

     public function task()
     {
         return $this->belongsTo('App\Task');
     }

     public function meassage()
     {
         return $this->belongsTo('App\Message');
     }
     
 

}
