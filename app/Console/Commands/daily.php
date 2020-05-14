<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Notifications\newCorpseNotification;
use Illuminate\Support\Facades\Notification;
use App\Events\overThirtyDays;
use App\Corpse;
use App\Events\fifteenDays;
use App\Events\pendingNoPostmortem;
use App\Events\postCompleteNoBuried;
use App\Events\tweentyFiveDays;
use App\User;
class daily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to admin for bodies over 30 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function storageday($pickupDate,$burialDate )
    {
        $pickup_date = Carbon::parse($pickupDate);
        $burial_date = Carbon::parse($burialDate);

        $now = Carbon::now();
        if (  $burialDate !='' || $burialDate !=null ) {
          return  $burial_date->diffInDays( $pickup_date );
        }else{
            $pickup_date = Carbon::parse($pickupDate);
            return $now->diffInDays( $pickup_date );
        }
    }







    public function thirty_Over()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30 && $corpse->burial_date =='')
                    {  $name='';
                        if ($corpse->first_name =='Unidentified') {
                            if ($corpse->suspected_name!=''){
                                $name='* '.$corpse->suspected_name.' *';
                            }else{
                                $name='Unidentified';
                            }
                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'superAdmin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'Overthirty',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );


                    if (\Notification::send($sendTo, new newCorpseNotification($data))) { }


                     event(new overThirtyDays($sendTo,  $data));

                 }
        }

      echo 'DONE !';

    }










    

    public function thirty_Over_days_div_Admin()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30 && $corpse->burial_date =='')
                    {  $name='';
                        if ($corpse->first_name =='Unidentified') {
                            if ($corpse->suspected_name!=''){
                                $name='* '.$corpse->suspected_name.' *';
                            }else{
                                $name='Unidentified';
                            }
                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }

                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'Admin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'Overthirty',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );

                    foreach($sendTo as $user){                      
                        if ($corpse->station->division->id=== $user->division_id) {
                             event(new overThirtyDays($sendTo,  $data));
                            if (\Notification::send($sendTo, new newCorpseNotification($data))) { }                   
                    }      
 
                 }
        }
    }

      echo 'DONE !';

    }




    public function fifteenDays()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) == 15 && $corpse->postmortem_date ==''&& $corpse->burial_date =='')
                    {  $name='';
                     if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                    $name='* '.$corpse->suspected_name.' *';
                                }else{
                                    $name='Unidentified';
                                }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'superAdmin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'FifteenDays',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );



                    if (\Notification::send($sendTo, new newCorpseNotification($data))) { }

                     event(new fifteenDays($sendTo,  $data));

                 }
        }
      // dd( $data);

      echo 'DONE !';
    }




    public function fifteenDays_div_admin()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) == 15 && $corpse->postmortem_date ==''&& $corpse->burial_date =='')
                    {  $name='';
                     if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                    $name='* '.$corpse->suspected_name.' *';
                                }else{
                                    $name='Unidentified';
                                }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'Admin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'FifteenDays',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );

                        foreach($sendTo as $user){                      
                            if ($corpse->station->division->id=== $user->division_id) {
                                event(new overThirtyDays($sendTo,  $data));
                                if (\Notification::send($sendTo, new newCorpseNotification($data))) { }                   
                        } 
                    }
                 }
        }
      // dd( $data);

      echo 'DONE !';
    }


    public function twentyFiveDays()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) == 25 && $corpse->postmortem_date ==''&& $corpse->burial_date =='')
                    {  $name='';
                        if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                $name='* '.$corpse->suspected_name.' *';
                            }else{
                                $name='Unidentified';
                            }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                     }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'superAdmin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'TwentyFiveDays',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish
                    );

                    if (\Notification::send($sendTo, new newCorpseNotification($data))) { }
                     event(new tweentyFiveDays($sendTo,  $data));
                 }
        }

      echo 'DONE !';
    }




    
    public function twentyFiveDays_div_admin()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) == 25 && $corpse->postmortem_date ==''&& $corpse->burial_date =='')
                    {  $name='';
                        if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                $name='* '.$corpse->suspected_name.' *';
                            }else{
                                $name='Unidentified';
                            }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                     }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'Admin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'TwentyFiveDays',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish
                    );

                    foreach($sendTo as $user){                      
                        if ($corpse->station->division->id=== $user->division_id) {
                            event(new overThirtyDays($sendTo,  $data));
                            if (\Notification::send($sendTo, new newCorpseNotification($data))) { }                   
                    } 
                }
                 }
        }

      echo 'DONE !';
    }







    public function postmortemCompNotBuried()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) >= 25 && $corpse->postmortem_date !='' && $corpse->postmortem_status =='Completed'&& $corpse->burial_date =='')
                    {  $name='';
                     if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                    $name='* '.$corpse->suspected_name.' *';
                                }else{
                                    $name='Unidentified';
                                }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'superAdmin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'PostCompletedNotBuried',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );



                    if (\Notification::send($sendTo, new newCorpseNotification($data))) { }

                     event(new postCompleteNoBuried($sendTo,  $data));

                 }
        }
      // dd( $data);

      echo 'DONE !';
    }



    public function postmortemCompNotBuried_div_admin()
    {
        $storagedays=array();
        $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
            foreach ($corpses as $corpse) {
                    if (  $this->storageday($corpse->pickup_date, $corpse->burial_date) >= 25 && $corpse->postmortem_date !='' && $corpse->postmortem_status =='Completed'&& $corpse->burial_date =='')
                    {  $name='';
                     if ($corpse->first_name =='Unidentified') {

                            if ($corpse->suspected_name!=''){
                                    $name='* '.$corpse->suspected_name.' *';
                                }else{
                                    $name='Unidentified';
                                }

                        } else {
                            $name= $corpse->first_name.'  '.$corpse->last_name ;
                        }


                    $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'Admin');
                    })->get();

                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'PostCompletedNotBuried',
                        "name" =>  $name,
                        'location'=>$corpse->pickup_location,
                        'pickupdate'=>$corpse->pickup_date,
                        'station' => $corpse->station->station,
                        "division" => $corpse->station->division->division,
                        "parish" => $corpse->parish,
                      // "user" => auth()->user()->email
                    );

                    foreach($sendTo as $user){                      
                        if ($corpse->station->division->id=== $user->division_id) {
                            event(new overThirtyDays($sendTo,  $data));
                            if (\Notification::send($sendTo, new newCorpseNotification($data))) { }                   
                    } 
                   }

                 }
        }   echo 'DONE !';
    }


public function pending_and_no_postmortem(){
     $now= Carbon::now();
    $storagedays=array();
    $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
        foreach ($corpses as $corpse) {

                if ( $corpse->postmortem_date < $now && $corpse->burial_date == '' && $corpse->postmortem_status=='Pending')
                {

                        $addThree = Carbon::parse($corpse->postmortem_date);
                        $pickup_date = Carbon::parse($corpse->postmortem_date);
                         $addThree->addWeekdays(5);
                        if( $addThree->from($pickup_date)==5){

                                $name='';
                            if ($corpse->first_name =='Unidentified') {

                                    if ($corpse->suspected_name!=''){
                                            $name='* '.$corpse->suspected_name.' *';
                                        }else{
                                            $name='Unidentified';
                                        }

                                } else {
                                    $name= $corpse->first_name.'  '.$corpse->last_name ;
                                }


                            $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                            $sendTo = User::whereHas('roles', function ($query) {
                                $query->where('name', '=', 'superAdmin');
                            })->get();

                            $data = array(
                                "id" => $corpse->id,
                                "type" => 'PendingPastNoPostmortem',
                                "name" =>  $name,
                                'location'=>$corpse->pickup_location,
                                'pickupdate'=>$corpse->pickup_date,
                                'station' => $corpse->station->station,
                                "division" => $corpse->station->division->division,
                                "parish" => $corpse->parish,
                            // "user" => auth()->user()->email
                            );



                            if (\Notification::send($sendTo, new newCorpseNotification($data))) { }

                            event(new pendingNoPostmortem($sendTo,  $data));

                        }
            }
    }
  // dd( $data);

  echo 'DONE !';
}







public function pending_and_no_postmortem_div_admin(){
    $now= Carbon::now();
   $storagedays=array();
   $corpses= Corpse::where('pickup_date', '!=',null)->where('body_status',"Unclaimed")->get();
       foreach ($corpses as $corpse) {

               if ( $corpse->postmortem_date < $now && $corpse->burial_date == '' && $corpse->postmortem_status=='Pending')
               {

                       $addThree = Carbon::parse($corpse->postmortem_date);
                       $pickup_date = Carbon::parse($corpse->postmortem_date);
                        $addThree->addWeekdays(5);
                       if( $addThree->from($pickup_date)==5){

                               $name='';
                           if ($corpse->first_name =='Unidentified') {

                                   if ($corpse->suspected_name!=''){
                                           $name='* '.$corpse->suspected_name.' *';
                                       }else{
                                           $name='Unidentified';
                                       }

                               } else {
                                   $name= $corpse->first_name.'  '.$corpse->last_name ;
                               }


                           $storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=>  $name );
                           $sendTo = User::whereHas('roles', function ($query) {
                               $query->where('name', '=', 'Admin');
                           })->get();

                           $data = array(
                               "id" => $corpse->id,
                               "type" => 'PendingPastNoPostmortem',
                               "name" =>  $name,
                               'location'=>$corpse->pickup_location,
                               'pickupdate'=>$corpse->pickup_date,
                               'station' => $corpse->station->station,
                               "division" => $corpse->station->division->division,
                               "parish" => $corpse->parish,
                           // "user" => auth()->user()->email
                           );

                           foreach($sendTo as $user){                      
                            if ($corpse->station->division->id=== $user->division_id) {
                                event(new overThirtyDays($sendTo,  $data));
                                if (\Notification::send($sendTo, new newCorpseNotification($data))) { }                   
                        } 
                       }
    

                       }
           }
   }
 // dd( $data);

 echo 'DONE !';


}








    public function handle()
    {
       $this->fifteenDays();
       $this->twentyFiveDays_div_admin();
       $this->fifteenDays_div_admin();
       $this->twentyFiveDays();
       $this->thirty_Over();
       $this->pending_and_no_postmortem();
       $this->pending_and_no_postmortem_div_admin();
       $this->postmortemCompNotBuried();
       $this->postmortemCompNotBuried_div_admin();
       $this->thirty_Over_days_div_Admin();
    }






}
