<?php

namespace App;
use App\Funeralhome;
use App\Investigator;
use App\User;
use App\Condition;
use App\Anatomy;
use App\Manner;
use App\Task;
use App\Station;
use Carbon\Carbon;
use App\Dna;
use App\Occurrence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class corpse extends Model
{



  
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 
  
   

    public function occurrence()
    {
        return $this->hasOne('App\Occurrence');
    }


    public function getDna()
    {
        return $this->hasOne('App\Dna');
    }


    public function condition()
    {
        return $this->belongsTo('App\Condition');
    }

    public function manner()
    {
        return $this->belongsTo('App\Manner');
    }

    public function anatomy()
    {
        return $this->belongsTo('App\Anatomy');
    }
    public function funeralhome()
    {
        return $this->belongsTo('App\Funeralhome');
    }

    public function corpse()
    {
        return $this->hasMany('App\Corpse');
    }

    public function investigator()
    {
        return $this->hasMany('App\Investigator');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function station()
    {
        return $this->belongsTo('App\Station');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function storagedays()
    {
        if($this->body_status=="Unclaimed"){
            $pickup_date = Carbon::parse($this->pickup_date);
            $burial_date = Carbon::parse($this->burial_date);

            $now = Carbon::now();
            if ($this->buried ==='Yes' && $this->burial_date !='' ) {
            return  $burial_date->diffInDays( $pickup_date );
            }else{
                $pickup_date = Carbon::parse($this->pickup_date);
                return $now->diffInDays( $pickup_date );
            }
        }else {
            return  $now =0;
          }
          

    }


    public function processTime()
    {

        $processTime=0;
        if($this->body_status=="Unclaimed"){
            $pickup_date = Carbon::parse($this->pickup_date);
            $postmortem_date = Carbon::parse($this->postmortem_date);
            if ( $this->postmortem_date != '') {
                $processTime= $postmortem_date->diffInDays( $pickup_date );
            }else{
                $processTime=0;
            }
            return  $processTime;
        } else {
          return  $processTime=0;
        }
        
 
        
    }
 
    public function dateResultConverter($dateToConvert)
    {
      if ($this->getDna->dna_result_date !='') {
        $convered = Carbon::parse($dateToConvert);        
        return  $convered->format('l jS \\of F Y');
      } else {
        return  '';
     }
     
    }


    public function dateRequestConverter($dateToConvert)
    {
      if ($this->getDna->dna_request_date !='') {
        $convered = Carbon::parse($dateToConvert);        
        return  $convered->format('l jS \\of F Y');
      } else {
        return  '';
     }     
    }


    public function dateConverter($dateToConvert)
    {
      if ($dateToConvert !='') {
        $convered = Carbon::parse($dateToConvert);        
        return  $convered->format('l jS \\of F Y');
      } else {
        return  '';
     }     
    }

    public function dnaRequestTimePeriod()
    {
        $dnaRequestTimePeriod='';
        $dna_request_date = Carbon::parse($this->getDna->dna_request_date);
        $dna_result_date = Carbon::parse($this->getDna->dna_result_date);
        if ( $this->getDna->dna_result_date != '') {
            $dnaRequestTimePeriod = $dna_request_date->diffInDays( $dna_result_date )." Day(s)";
        }else{
            $dnaRequestTimePeriod= $dna_request_date->diffInDays( Carbon::now())." Day(s)";
        }
        return  $dnaRequestTimePeriod;
    }


    public function dnaResultProcessTime()
    {

        $dnaResultProcessTime='';
        if ( $this->getDna->dna_result_date != '') {
                $dna_request_date = Carbon::parse($this->getDna->dna_request_date);
                $dna_result_date = Carbon::parse($this->getDna->dna_result_date);
                if ( $this->getDna->dna_request_date != '' && $this->getDna->dna_request_date != '') {
                    $dnaResultProcessTime = $dna_result_date->diffInDays($dna_request_date)." Day(s)";
                }else{ 
                }
        }
        return  $dnaResultProcessTime;
    }




 public function excess() {
        if($this->body_status=="Unclaimed"){
            $now = Carbon::now();
            $pickup_date = Carbon::parse($this->pickup_date);
            $burial_date = Carbon::parse($this->burial_date);
            if ($this->buried ==='Yes' && $this->burial_date !='' ) {
                return  $burial_date->diffInDays( $pickup_date ) - 30;
            }else{
            return $now->diffInDays( $pickup_date ) - 30;

            }
       }else{
        return  $now=0;
       }
    }

}
