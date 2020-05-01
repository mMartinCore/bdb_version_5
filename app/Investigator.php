<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Rank;
use Illuminate\Support\Facades\App;
use App\Corpse;
use App\Station;

class Investigator extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  


    public $table = 'investigators';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'investigator_first_name',
        'investigator_last_name',
        'regNum',
        'assign_date',
        'contact_no',
        'corpse_id',
        'rank_id',
        'station_id',
        'user_id',
        'modified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'investigator_first_name' => 'string',
    //     'investigator_last_name' => 'string',
    //     'regNum' => 'integer',
    //     'assign_date' => 'date',
    //     'contact_no' => 'string',
    //     'corpse_id' => 'integer',
    //     'rank_id' => 'integer',
    //     'station_id' => 'integer',
    //     'user_id' => 'integer',
    //     'modified_by' => 'integer'
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    // public static $rules = [
    //     'investigator_first_name' => 'required',
    //     'investigator_last_name' => 'required',
    //     'regNum' => 'required',
    //     'assign_date' => 'required',
    //     'contact_no' => 'required',
    //     'corpse_id' => 'required',
    //     'rank_id' => 'required',
    //     'station_id' => 'required',
    // ];

    public function rank()
    {
        return $this->belongsTo('App\Rank');
    }

    public function station()
    {
        return $this->belongsTo('App\Station');
    }

    public function corpse()
    {
        return $this->belongsTo('App\Corpse');
    }


}
