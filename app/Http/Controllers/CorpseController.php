<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Notifications\newCorpseNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCorpseRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Corpse;
use App\Division;
use Illuminate\Http\Request;
use Flash;
use App\Dna;
use App\Funeralhome;
use Response;
use App\Station;
use App\Rank;
use App\Investigator;
use App\Listeners\SendPauperBurialRequestEmail;
use App\Listeners\senddenyEmail;
use App\Listeners\SendWelcomeEmail;
use App\Events\pauperBurialRequest;
use App\Events\requestStatus;
use App\Events\deny;
use App\Task;
use Carbon\Carbon;
use App\User;
use App\Exports\CorpseExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Manner;
use App\Condition;
use App\Anatomy;
use App\Message;
use Session;
use App\Occurrence;
use  Charts;
use App\Parish;
use App\Http\Controllers\mysql_real_escape_string;
//use Illuminate\Notifications\Notification;
use  Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use function PHPSTORM_META\type;

class CorpseController extends Controller
{
    /** @var  CorpseRepository */
    private $corpseRepository;
    public $regNo = '';
    public $countVal = 0;
    public $regNunWithOther = '';
    public $antherVariable = 0;
    public $exportCorpse=array();


    public function __construct() {
        //$this->middleware(['auth']);
          $this->middleware(['clearance','auth']);
    }
    /**
     * Display a listing of the Corpse.
     *
     * @param Request $request
     *
     * @return Response
     */






    public function clearCaches(){
        Cache::forget('Caches_key_parishes');
        Cache::forget('cache_key_dashboard');
        Cache::forget('cache_key_approve_list'); 
        Cache::forget('cache_key_notApprove_list');              
        Cache::forget('cache_key_dashboard_burial_request');
        Cache::forget('cache_key_dashboard_burial_NotApproved');
        Cache::forget('cache_key_dashboard_post_mortem_pending');
        Cache::forget('cache_key_dashboard_divisionOverThirstyDays');
        Cache::forget('cache_key_dashboard_stationOverThirstyDays');
    }




    public function index()
    {
        // $corpses = Corpse::orderBy('created_at', 'desc')->get();
        $funeralhomes =  cache()->remember('Caches_key_CorpseIndexFuneralHome',Session::get('caches_time'), function () {
            return  Funeralhome::get();
        });
        $auth_user_div_id= auth()->user()->station->division->id;  
        $parishes= cache()->remember('cache_key_parish_corpse_index',Session::get('caches_time'), function () {
            return  Parish::get();
        });

  
        if(!auth()->user()->hasRole('SuperAdmin')){
            
            $stations = cache()->remember('Caches_key_CorpseIndexStations',Session::get('caches_time'), function () use( $auth_user_div_id) {
                return  Station::where('division_id', $auth_user_div_id)->get();
            });       
 
            $divisions= cache()->remember('Caches_key_corpse_index_Division',Session::get('caches_time'), function () use( $auth_user_div_id){
                return  Division::where('id', $auth_user_div_id)->get();
            });

            $total_records=Corpse::where('division_id', $auth_user_div_id)->count();
            $corpses=Corpse::where('division_id', $auth_user_div_id)->latest('updated_at')->paginate(10);
         }else{
            $divisions= cache()->remember('Caches_key_corpse_index_Division',Session::get('caches_time'), function () {
                return   Division::get();
            });
            $total_records=Corpse::count();
            $corpses=Corpse::latest('updated_at')->paginate(10);
            $stations = cache()->remember('Caches_key_CorpseIndexStations',Session::get('caches_time'), function ()  {
                return  Station::get();
            });
         }   
         

         $conditions= cache()->remember('Caches_key_corpse_index_Condition',Session::get('caches_time'), function () {
            return Condition::get();   
        });  

     
         
        $manners= cache()->remember('Caches_key_CorpseIndexManners',Session::get('caches_time'), function () {
            return Manner::get();  
        });

         $anatomies= cache()->remember('Caches_key_corpse_index_Anatomy',Session::get('caches_time'), function () {
            return Anatomy::get();   
        });   

         $ranks = cache()->remember('cache_key_RanksCorpseIndex',Session::get('caches_time'), function () {
            return Rank::get(); // Rank::paginate(10); 
        });

         return view('corpses.index', compact('funeralhomes','corpses', 'parishes','stations','conditions','manners','anatomies','total_records','divisions'));
    }


    public function export()
    {
        $da = array(); 
        $da =Session::get('getExportList');
        return Excel::download(new CorpseExport( collect($da)), 'Corpses.xlsx');
    }




    public function setExportList($list)
    {

        return  $this->exportCorpse=$list;
    }


    public function getExportList()
    {
        return $this->exportCorpse;
    }














public function recentActivities(){


    $table = '';
    $count = 0;
    $storagedays = '';
    $excess = 0;
    $name = '';
if(!auth()->user()->hasRole('SuperAdmin')){
    $corpses = Corpse::where('division_id', auth()->user()->station->division->id)->latest('updated_at')->take(7)->get();
}else{
    $corpses = Corpse::latest('updated_at')->take(7)->get();
}
        foreach ($corpses as $key => $corpse) {

            $storagedays = $this->storageday($corpse->pickup_date, $corpse->burial_date);
            if ($storagedays >= 30 && $corpse->burial_date == '') {

                $storagedays =  $storagedays;

                if ($storagedays > 30) {

                    $excess = $storagedays - 30;


                    if ($excess > 0) {
                    } else {
                        $excess = 0;
                    }
                } else {
                    $excess = 0;
                }

                // $overThirty=
            } elseif ( $storagedays <= 30 && $corpse->burial_date =='') {
                $excess = 0;
                $storagedays = $storagedays;
            }else{
                $excess = 0;
            }


            if ($corpse->first_name == "Unidentified") {

                if ($corpse->suspected_name != '')
                    $name = '*' .ucfirst( $corpse->suspected_name). '*';
                else {
                    $name = 'Unidentified';
                }
            } else {
                $name =ucfirst($corpse->first_name) . ' ' . ucfirst($corpse->middle_name) . ' ' . ucfirst($corpse->last_name);
            }


            if(auth()->user()->hasRole('SuperAdmin')){
                // $del='SuperAdmin|Admin|viewer|write';
                $table .= '<tr>
                <td>' .'<a class="btn showViewModal btn-success btn-xs"   onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
                .'<td>' . $name . '</td>
                .<td>' . $corpse->death_date . '</td>
                .<td>' . $corpse->pickup_date . '</td>
                .<td>' . $corpse->postmortem_status . '</td>
                .<td>' . $corpse->pauper_burial_requested . '</td>
                .<td>' . $corpse->pauper_burial_approved . '</td>
                .<td>' . $corpse->buried . '</td>
                .<td>' . $storagedays . '</td>
                .<td>' . $excess . '</td>
                .<td>
                <div class="btn-group no">
              <a href="/corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
             '     </div>'

            . '</td>
            </tr>';
        $count++;
    }else  if(auth()->user()->hasRole('Admin')){
        $table .= '<tr>
        <td>' .'<a  class="btn showViewModal btn-success btn-xs"  onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
        .'<td>' . $name . '</td>
        .<td>' . $corpse->death_date . '</td>
        .<td>' . $corpse->pickup_date . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">'
        .'<a href="/corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
    ' </div>'

    . '</td>
    </tr>';
    $count++;
    }

    else  if(auth()->user()->hasRole('writer')){
        $table .= '<tr>
        <td>' .'<a class="btn showViewModal btn-success btn-xs"   onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
        .'<td>' . $name . '</td>
        .<td>' . $corpse->death_date . '</td>
        .<td>' . $corpse->pickup_date . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">
        <a href="/corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
    ' </div>'

    . '</td>
    </tr>';
$count++;
    }

    else  if(auth()->user()->hasRole('viewer')){
        $table .= '<tr>
        <td>' .'<a class="btn showViewModal btn-success btn-xs"   onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
        .'<td>' . $name . '</td>
        .<td>' . $corpse->death_date . '</td>
        .<td>' . $corpse->pickup_date . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">
        <a   class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-bar"></i>none</a>' 
        .'</div>'
    . '</td>
    </tr>';
$count++;
    }



}


$data = array(
    'table' => $table,
    'cnt' => $count
 ,
);

return response($data);
}




















    public function approve()
    {
        if(!auth()->user()->hasRole('SuperAdmin')){

            $corpses = cache()->remember('cache_key_approve_list',Session::get('caches_time'), function ()  {
                return  Corpse::where('pauper_burial_approved', 'Processing')->where('division_id', auth()->user()->station->division->id  )->get();//paginate(10);
                });  
        }else {
           $corpses = cache()->remember('cache_key_approve_list',Session::get('caches_time'), function ()  {
                return      Corpse::where('pauper_burial_approved', 'Processing')->get();//paginate(10);
                }); 
            }
        $listType="Request";
        return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }



    public function notApprove()
    {
        if(!auth()->user()->hasRole('SuperAdmin')){
            $corpses = cache()->remember('cache_key_notApprove_list',Session::get('caches_time'), function ()  {
                return     Corpse::where('pauper_burial_approved', 'No')->where('division_id', auth()->user()->station->division->id  )->get();//paginate(10);
                }); 
        }else{
            
            
            $corpses = cache()->remember('cache_key_notApprove_list',Session::get('caches_time'), function ()  {
                return     Corpse::where('pauper_burial_approved', 'No')->get();//paginate(10);
                }); 
                 
        }
        $listType="Request Denied";
        return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }


    public function noRequest()
    {     if(!auth()->user()->hasRole('SuperAdmin')){
        $corpses = Corpse::where('pauper_burial_approved', 'No-Request')->where('division_id', auth()->user()->station->division->id  )->paginate(10);
    }else {
        $corpses = Corpse::where('pauper_burial_approved', 'No-Request')->paginate(10);
    }
    $listType="No-Request";
    return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }





    public function thirtyDaylist()
    {
        if(!auth()->user()->hasRole('SuperAdmin')){
            $corpses = Corpse::where('division_id', auth()->user()->station->division->id)->where('body_status',"Unclaimed")->paginate(10);
        }else{
            $corpses = Corpse::where('body_status',"Unclaimed")->paginate(10);
        }

        return view('corpses.thirtyDaylist')->withCorpses($corpses);
    }






    public function approved(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'corpse_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
            $corpse = Corpse::findOrFail( $this->test_input($request->input('corpse_id')));
            if ($corpse->pauper_burial_requested == 'No') {
                $success_output = '<div class="alert alert-danger"> No request made for this corpse. Please make a request first ! </div>';
            } else {
                try {
                    $corpse->pauper_burial_approved = "Approved";
                    $corpse->pauper_burial_approved_date = date("Y-m-d H:i:s");
                    $corpse->modified_by  = auth()->user()->id;

                    $corpse->update();

                        } catch (\Throwable $th) {
                            $error_array = ['Error, Something occurred while making Approval !'];
                        }
                         $success_output = '<div class="alert alert-success"> Request Approved Sucessfully! </div>';

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

                     try {
                            $data = array(
                                "id" => $corpse->id,
                                "type" => 'Approved',
                                "name" =>  $name,
                                'location'=>$corpse->pickup_location,
                                'pickupdate'=>$corpse->pickup_date,
                                'station' => $corpse->station->station,
                                "division" => $corpse->station->division->division,
                                "parish" =>  $corpse->station->division->parish->parish ,
                            // "user" => auth()->user()->email
                            );

                            Session::put('$div_id',$corpse->station->division->id);
                            $sendTo = User::where('id', '=', $corpse->user_id)->get();
                            if (\Notification::send($sendTo, new newCorpseNotification($data))) {  }

                            $sendToAdmin = User::whereHas('roles', function ($query )
                            {
                                $query->where('name', '=', 'Admin')->Where('division_id', '=', Session::get('$div_id') );
                            })->get();

                            if (\Notification::send($sendToAdmin, new newCorpseNotification($data))) {  }

                      }
                      catch (\Throwable $th) {
                        $error_array = ['Your Info Approved. However something occurred while sending Notification!'];
                       }


                    try {
                            event(new requestStatus($sendTo,  $data));

                    } catch (\Throwable $th) {
                        $error_array = ['Your Info Approved. However we could not establish connection dispatch email service!'];
                    }








            }


            //  }
            // catch (\Throwable $th) {
            //     $error_array =['Error, Something occurred while saving!'];
            // }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }



    public function deny(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'corpse_id' => 'required',
            'task' => 'required|min:7|max:500', 
        ]);

        $error_array =array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            $corpse = Corpse::findOrFail( $this->test_input($request->input('corpse_id')));
            if ($corpse->pauper_burial_requested == 'No') {
                $success_output = '<div class="alert alert-info"> No request made for this corpse. Please make a request first ! </div>';
            } else {
                try {
                    $corpse->pauper_burial_requested = "No";
                    $corpse->pauper_burial_requested_date =null;
                    $corpse->pauper_burial_approved = "No";
                    $corpse->pauper_burial_approved_date = date("Y-m-d H:i:s");
                    $corpse->modified_by  = auth()->user()->id;
                    $corpse->update();
                    $this->clearCaches(); 
                    $success_output = '<div class="alert alert-success"> Request Denied Sucessfully! </div>';
                } catch (\Throwable $th) {
                    $error_array = ['Error, Something occurred while updating denial request!'];
                }



                $data = array(
                    "id" => $corpse->id,
                    "type" => 'Denied',
                    "first_name" => $corpse->first_name,
                    "last_name" => $corpse->last_name,
                    "division" => $corpse->station->division->division,
                    "parish" =>  $corpse->station->division->parish->parish ,
                    "user" => auth()->user()->email
                );

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

                $dataEmail = array(
                    "id" => $corpse->id,
                    "cr_no" => $corpse->cr_no,
                    "name" => $name,
                    'location'=>$corpse->pickup_location,
                    'pickupdate'=>$corpse->pickup_date,
                    'station' => $corpse->station->station,
                    "division" => $corpse->station->division->division,
                    "parish" =>  $corpse->station->division->parish->parish
                );


                $sendTo = User::whereHas('roles', function ($query) {
                    $query->where('name', '=', 'superAdmin');
                })->get();

                try {
                    if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                        // return back();
                    }
                } catch (\Throwable $th) {
                         $error_array = ['Error, Something occurred while sending Notification real-time !'];    
            
                }


                try {

                        event(new deny($sendTo, $dataEmail));

                } catch (\Throwable $th) {
                         $error_array =   ['Your request was denied. However we could not establish connection dispatch email service! '];  
                }





///////////////////////////////////////////////

$task = new Task();
$task->user_id = auth()->user()->id;
$task->address_to_id =  $corpse->user_id;
$task->corpse_id =   $this->test_input( $request->input('corpse_id'));
$task->task =   $this->test_input($request->input('task'));
$task->modify_by = 0;
try{
$task->saveOrFail();
}
catch (\Throwable $th) {
         $error_array =    ['Error, Something occurred while saving task ! '];    
 
}
$sendTo = User::where('id', '=', $task->address_to_id)->get();
$data = array(
    'id' => $task->corpse_id,
    'type' => 'task',
    "from" => auth()->user()->email
);

try{
    if (\Notification::send($sendTo, new newCorpseNotification($data))) {
      // return back();
    }
 }
catch (\Throwable $th) {

         $error_array =    ['Error,  Something occurred while sending Notification real-time !'];  
}



//////////////////////////////////////////
 

            }


            //  }
            // catch (\Throwable $th) {
            //     $error_array =['Error, Something occurred while saving!'];
            // }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }









    public function makeRequest(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'corpse_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {



                $corpse = Corpse::findOrFail($request->input('corpse_id'));
                if ( $corpse->pauper_burial_requested == 'No') {
                    $corpse->pauper_burial_requested ='Yes';
                    $corpse->pauper_burial_requested_date = date("Y-m-d H:i:s");
                    $corpse->pauper_burial_approved = "Processing";


                    try {
                     $corpse->modified_by  = auth()->user()->id;
                    $corpse->update();
                    $this->clearCaches(); 
                    $success_output = '<div class="alert alert-success"> Re-open to view changes  </div>';

                    } catch (\Throwable $th) {
                        throw  $error_array = ['Error, Something occurred while updating!'];
                    }




 
                    $data = array(
                        "id" => $corpse->id,
                        "type" => 'Request',
                        "first_name" => $corpse->first_name,
                        "last_name" => $corpse->last_name,
                        "division" => $corpse->station->division->division,
                        "parish" =>  $corpse->station->division->parish->parish ,
                        "user" => auth()->user()->email
                    );

                    $sendTo = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'superAdmin');
                    })->get();

                    try {
                        if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                            // return back();
                        }
                    } catch (\Throwable $th) {
                        $error_array = ['Your request was made. However something occurred while sending Notification real time.  Re-open to view changes.'];
                    }



                    try {

                            event(new pauperBurialRequest($sendTo,  $corpse));

                    } catch (\Throwable $th) {
                        $error_array = ['Your request was made. However we could not establish connection dispatch email service!'];
                    }





                } else {

                    $success_output = '<div class="alert alert-warning"> Request already made for this corpse! </div>';
                }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }








    public function getCorpses()
    {

        $corpses = Corpse::orderBy('created_at', 'desc')->get();

        $table = '';
        $storagedays = '';
        foreach ($corpses as $corpse) {

            if ($corpse->storagedays() >= 30) {
                $storagedays =  $corpse->storagedays();
            } elseif ($corpse->storagedays() >= 20 && $corpse->storagedays() < 25) {
                $storagedays = $corpse->storagedays();
            }

            $storagedays = $corpse->storagedays();

            $table .= '<tr><td>' . $corpse->unidentified . '</td>
                .<td>' . $corpse->first_name . '</td>
                .<td>' . $corpse->last_name . '</td>
                .<td>' . $corpse->middle_name . '</td>
                .<td>' . $corpse->sex . '</td>
                .<td>' . $corpse->death_date . '</td>
                .<td>' . $corpse->pauper_burial_requested . '</td>
                .<td>' . $corpse->pauper_burial_approved . '</td>
                .<td>' . $corpse->buried . '</td>
                .<td>' . $storagedays . '</td>
          </tr>';
        }



        //  return response($table);
    }



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

    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       $data =htmlentities( $data );
       $data = strip_tags( $data );
       $data= str_replace("--"," ",$data,$i);
       $data= str_replace("/"," ",$data,$i);
       $data= str_replace(";"," ",$data,$i);
       $data= str_replace("'"," ",$data,$i);
       $data= str_replace("'"," ",$data,$i);
       $data= str_replace(","," ",$data,$i);
       $data= str_replace("<"," ",$data,$i);
       $data= str_replace(">"," ",$data,$i);
       $data= str_replace("#"," ",$data,$i);
       $data= str_replace("%"," ",$data,$i);
       $data= str_replace("("," ",$data,$i);
       $data= str_replace("="," ",$data,$i);
       $data= str_replace(")"," ",$data,$i);
       $data= str_replace("*"," ",$data,$i);
        //$data = mysql_real_escape_string($data);
        return $data;
    }

 




    public function storageDayOverThirty($pickup_date)
    {
        $now = Carbon::now();
        $pickupDate = Carbon::parse($pickup_date);
        return $now->diffInDays($pickupDate);
    }








public function checkUniqueCrNo(Request $request){
    $validation = Validator::make($request->all(), [
        'diary_no' => 'required|min:1|max:4',
        'entry_date' => 'required|date',
        'diary_type' => 'required',
        'stn_id' => 'required'
    ]);
    $error_array = array();
    $success_output = '';
    if ($validation->fails()) {
        foreach ($validation->messages()->getMessages() as $field_name => $messages) {
            $error_array[] = $messages;
        }
    } else {
         try {

            $diary_type= $request->input('diary_type');
            $diary_no= $request->input('diary_no');
            $entry_date= $request->input('entry_date');
            $stn_id=$request->input('stn_id');
            $stn_code = Station::findOrFail( $stn_id);

            $newCr_no=  $diary_no.$diary_type.$entry_date.$stn_code->stationCode;

        $corpse = Corpse::where('cr_no' ,   $newCr_no )->pluck('cr_no');

            if( $corpse !='[]'){
                return    $error_array = '<div class="alert alert-danger"> Corpse already exist!'.$corpse.' </div>'; 
              
            }else{
                $success_output = '';
            }

         }
        catch (\Throwable $th) {
                $error_array = '<div class="alert alert-danger">  Something occurred while  checking ! </div>';  
         
        }

    }
    $output = array(
        'error'     =>  $error_array,
        'success'   =>  $success_output
    );

    echo json_encode($output);

}





    public function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            //  'id' => 'required|unique:corpses,id',
            'diary_no' => 'required|min:1|max:4',
            'entry_date' => 'required|date',
            'diary_type' => 'required',
            'summary' => 'required|min:7|max:1000',
            'corpse_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'unidentified' => 'required',
            'last_name' => 'sometimes|min:2|max:15',
            'middle_name' => 'sometimes|max:15',
            'suspected_name' => 'sometimes|max:15',
            'first_name' => 'min:3|max:15',
            'dob' => 'sometimes|date',

            'dna_date' => 'nullable|date',
            'dna_result_date' => 'nullable|date', 
            'dna_result' => 'nullable|min:7|max:500',
            'death_date' => 'nullable|date',
            'sex' => 'required',
            'nationality' => 'required|max:50',
            'address' => 'sometimes|max:150',
            'volume_no' => 'nullable|string',
            'corpse_stn_id' => 'required',
            'pickup_date' => 'required|date',
            'pickup_location' => 'required|min:3|max:150',
            'type_death' => 'min:3|max:20',
            'manner_death' => 'required',
            'anatomy' => 'required',
            'condition' => 'required',
            'finger_print' => 'string',
            'finger_print_date' => 'sometimes|date',
            'gazetted' => 'string',
            'gazetted_date' => 'sometimes|date',
            'pauper_burial_requested' => 'nullable|string',
            'buried' => 'nullable|string',
            'burial_date' => 'sometimes|date',
            'postmortem_status' => 'string',
            'postmortem_date' => 'sometimes|date',
            'funeralhome_id' => 'required',
            'pathlogist' => 'sometimes|string',
            'cause_of_Death' => 'sometimes|string|min:7|max:1000',
            'investigator_first_name' => 'required|min:2|max:15',
            'investigator_last_name' => 'required|min:2|max:15',
            'rank_id' => 'required',
            'assign_date' => 'required|date',
            'contact_no' => 'min:10|max:13',
            'regNum' => 'required|min:3|max:6',
            'station_id' => 'required',

            'dr_contact' => 'nullable|min:10|max:13',
            'dr_name' => 'nullable|min:3|max:50',

            'next_of_kin' => 'nullable|min:3|max:50',
            'next_of_kin_contact' => 'nullable|min:10|max:13',
            'next_of_kin_email' => 'nullable|email',
        ]);




        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
       
            ///CHECK FOR DUPLICATE RECORDS
           

                $diary_type= $request->input('diary_type');
                $diary_no= $request->input('diary_no');
                $entry_date= $request->input('entry_date');
                $stn_id=   $request->input('corpse_stn_id');
                $stn_code = Station::findOrFail( $stn_id);
                $newCr_no=  $diary_no.$diary_type.$entry_date.$stn_code->stationCode; 
                try {
                $corpse = Corpse::where('cr_no' ,   $newCr_no )->pluck('cr_no');    
                } 
                catch (\Throwable $th) {
                $error_array = '<div class="alert alert-danger">  Something occurred while  checking for duplicated records ! </div>';              
                }



                if( $corpse !='[]'){
                     $error_array = ['Corpse already exist !'.' CR # : '.$corpse];                   
                }else{
                    //CONTINUE SAVING RECORDS         
                              
                            
                $corpse = new Corpse();
                $corpse->unidentified = $request->input('unidentified');
                if ($corpse->unidentified === "Yes") {
                    $corpse->body_status = 'Unclaimed';
                } else {
                    $corpse->body_status = $request->input('body_status');
                } 
                $corpse->last_name = $request->input('last_name');
                $corpse->middle_name = $request->input('middle_name');
                $corpse->first_name = $request->input('first_name');
                $corpse->suspected_name = $request->input('suspected_name');
             

                $corpse->dob = $request->input('dob');
                $corpse->death_date = $request->input('death_date');

                $corpse->sex = $request->input('sex');
                $corpse->nationality = $request->input('nationality');
                $corpse->address = $request->input('address');
                $corpse->station_id = $request->input('corpse_stn_id');
                $div_id = Station::findOrFail($corpse->station_id);
                $corpse->parish = $div_id->division->parish->id;
                $diary_type= $request->input('diary_type');
                $diary_no= $request->input('diary_no');
                $entry_date= $request->input('entry_date');

                $corpse->cr_no=  $diary_no.$diary_type.$entry_date.$div_id->stationCode;


                ///////////////////////////////////////////////////////
                try{
                    // Handle File Upload
                    if($request->hasFile('corpse_image')){
                        // Get filename with the extension
                        $image = $request->file('corpse_image');
                        // Get just filename
                        $filename = time().'.'.$image->getClientOriginalExtension();
                        $location=  storage_path('/app/public/'.$filename);
                        Image::make($request->file('corpse_image')->getRealPath())->resize(320, 240)->save($location);
                        $corpse->corpse_image =$filename;
                    }



                }
                catch (\Throwable $th) {
                    $error_array = ['Error. occurred while updating  image!'];
                }


                $corpse->dr_name = $request->input('dr_name');
                $corpse->dr_contact = $request->input('dr_contact');

                $corpse->next_of_kin = $request->input('next_of_kin');
                $corpse->next_of_kin_contact = $request->input('next_of_kin_contact');
                $corpse->next_of_kin_email = $request->input('next_of_kin_email');

                $corpse->division_id = $div_id->division_id;
                $corpse->pickup_date = $request->input('pickup_date');
                $corpse->pickup_location = $request->input('pickup_location');
                $corpse->type_death = $request->input('type_death');
                $corpse->manner_id = $request->input('manner_death');
                $corpse->anatomy_id = $request->input('anatomy');
                $corpse->condition_id = $request->input('condition');
                $corpse->finger_print = $request->input('finger_print');
                $corpse->finger_print_date = $request->input('finger_print_date');
                $corpse->gazetted = $request->input('gazetted');
                $corpse->volume_no = $request->input('volume_no');
                $corpse->gazetted_date = $request->input('gazetted_date');
                $Processing='No';
                if ($request->input('pauper_burial_requested') == "No" || $request->input('pauper_burial_requested')=='') {
                    $corpse->pauper_burial_requested = "No";
                    $corpse->pauper_burial_approved = 'No-Request'; ///////////////////////////////////
                } else if($request->input('pauper_burial_requested') == "Yes"){
                    $corpse->pauper_burial_requested = "Yes";
                    $corpse->pauper_burial_requested_date = date("Y-m-d H:i:s");
                    $corpse->pauper_burial_approved = 'Processing'; ///////////////////////////////////
                    $Processing='Processing';
                }



                if($request->input('buried')!=''){
                    $corpse->buried = $request->input('buried');
                }else{
                    $corpse->buried ="No";
                }

                $corpse->burial_date = $request->input('burial_date');
                $corpse->postmortem_status = $request->input('postmortem_status');
                $corpse->postmortem_date = $request->input('postmortem_date');
                $corpse->funeralhome_id = $request->input('funeralhome_id');
                $corpse->pathlogist = $request->input('pathlogist');

                $corpse->cause_of_Death = $request->input('cause_of_Death');
                $corpse->user_id = auth()->user()->id;
                $corpse->modified_by  = auth()->user()->id;

            try {
                $corpDate =   $corpse->save();
                $this->clearCaches(); 
            } catch (\Throwable $th) {
                    $error_array = ['Error, Something occurred while saving!'];
                }

                $investigator = new Investigator();
                $investigator->investigator_first_name =  $this->test_input( $request->input('investigator_first_name'));
                $investigator->investigator_last_name =  $this->test_input( $request->input('investigator_last_name'));
                $investigator->assign_date =  $this->test_input($request->input('assign_date'));
                $investigator->contact_no =  $this->test_input( $request->input('contact_no'));
                $investigator->rank_id =  $this->test_input($request->input('rank_id'));
                $investigator->station_id =   $this->test_input($request->input('station_id'));
                $investigator->regNum =   $this->test_input($request->input('regNum'));
                $investigator->corpse_id =    $corpse->id;
                $investigator->user_id = auth()->user()->id;
                $investigator->modified_by =  auth()->user()->id;
                try {

                    $investigator->save();
                   
                    




                } catch (\Throwable $th) {
                    $error_array = ['Error, Something occurred while saving Investigator!'];
                }



                try {
                    
                $summary = new Occurrence();        
                $summary->corpse_id =  $corpse->id;
                $summary->summary =    $request->input('summary'); 
                 $summary->save();
                } catch (\Throwable $th) {
                    $error_array = ['Error, Something occurred while saving summary!'];
                }
 


                $dna =  new Dna();
                $dna->corpse_id =  $corpse->id;
                $dna->dna= $request->input('dna'); 
                $dna->dna_request_date= $request->input('dna_date');
                $dna->dna_result_date= $request->input('dna_result_date');
                $dna->dna_result= $request->input('dna_result');
                $dna->save();   

                 
                $success_output = '<div class="alert alert-success"> Saved Sucessfully! </div>';
                $data = array(
                    "id" => $corpse->id,
                    "type" => 'Created',
                    "first_name" => $corpse->first_name,
                    "last_name" => $corpse->last_name,
                    "division" => $corpse->station->division->division,
                    "parish" =>  $corpse->station->division->parish->parish ,
                    "user" => auth()->user()->email
                );

                $sendTo = User::whereHas('roles', function ($query) {
                    $query->where('name', '=', 'superAdmin');
                })->get();

                try {
                    if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                        // return back();
                    }
                } catch (\Throwable $th) {
                    $error_array = ['Error, Something occurred while sending Notification!'];
                }


                try {
                    if ($Processing == 'Processing') {
                        event(new pauperBurialRequest($sendTo, Corpse::latest('id')->first()));
                    }
        
                } catch (\Throwable $th) {
                    $error_array = ['Your Info saved. However we could not establish connection dispatch email service!'];
                }       
                              
                                
            }    

 
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }











    public function editCorpse(Request $request)
    {
        $validation = Validator::make($request->all(), [
                'id' => 'required',
            // 'reference_id' => 'required',

            'corpse_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'summary' => 'required|min:7|max:1000',
            'unidentified' => 'required',
            'last_name' => 'sometimes|min:2|max:15',
            'middle_name' => 'sometimes|max:15',
            'suspected_name' => 'sometimes|max:15',
            'first_name' => 'min:3|max:15',
            'dob' => 'sometimes|date',
            'volume_no' => 'nullable|string',
            'dna_date' => 'nullable|date',
            'dna_result_date' => 'nullable|date', 
            'dna_result' => 'nullable|min:7|max:500',

            'death_date' => 'nullable|date',
            'sex' => 'required',
            'nationality' => 'required|max:50',
            'address' => 'sometimes|max:150',
            'corpse_stn_id' => 'required',
            'pickup_date' => 'required|date',
            'pickup_location' => 'required|min:3|max:150',
            'type_death' => 'min:3|max:20',
            'manner_death' => 'required',
            'anatomy' => 'required',
            'condition' => 'required',
            'finger_print' => 'string',

            'finger_print_date' => 'sometimes|date',
            'gazetted' => 'string',
            'gazetted_date' => 'sometimes|date',

            'buried' => 'nullable|string',
            'burial_date' => 'sometimes|date',
            'postmortem_status' => 'string',
            'postmortem_date' => 'sometimes|date',
            'funeralhome_id' => 'required',
            'pathlogist' => 'sometimes|string',
            'cause_of_Death' => 'sometimes|string|min:7|max:1000',

            'dr_contact' => 'nullable|min:10|max:13',
            'dr_name' => 'nullable|min:3|max:50',

            'next_of_kin' => 'nullable|min:3|max:50',
            'next_of_kin_contact' => 'nullable|min:10|max:13',
            'next_of_kin_email' => 'nullable|email',
        ]);




        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {
            try{
            $corpse =   Corpse::findOrFail( $request->input('id'));


        }
        catch (\Throwable $th) {
            $error_array = ['Error. occurred while query id !'];
        }
///////////////////////////////////////////////////////
try{
        // Handle File Upload
        if($request->hasFile('corpse_image')){          
           #delete old image
           Storage::disk('public')->delete('/'.$corpse->corpse_image);           
            // Get filename with the extension
            $image = $request->file('corpse_image');
            // Get just filename
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location=  storage_path('/app/public/'.$filename);
            Image::make($request->file('corpse_image')->getRealPath())->resize(320, 240)->save($location);
            $corpse->corpse_image =$filename;
        }


    }
    catch (\Throwable $th) {
        $error_array = ['Error. occurred while updating  image!'];
    }
        // if($request->hasFile('corpse_image')){
        //     // Get filename with the extension
        //     $filenameWithExt = $request->file('corpse_image')->getClientOriginalName();
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just ext
        //     $extension = $request->file('corpse_image')->getClientOriginalExtension();
        //     // Filename to store
        //     $corpse->corpse_image = $fileNameToStore= $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('corpse_image')->storeAs('public/images', $fileNameToStore);

        //     Image::make($request->file('corpse_image'))->resize(300, 200)->save('foo.jpg');

        // }

///////////////////////////////////////////////////////////////////////////////////////////////////////////


            $corpse->unidentified =  $request->input('unidentified');
            $corpse->body_status = $request->input('body_status');
            // if ($corpse->unidentified === "Yes") {
            //     $corpse->body_status = 'Unclaimed';
            // } else {
            //     $corpse->body_status = 'Claimed';
            // }
            $corpse->unidentified = $request->input('unidentified');
            $corpse->last_name =  $request->input('last_name');
            $corpse->middle_name =  $request->input('middle_name');
            $corpse->first_name =  $request->input('first_name');
            $corpse->suspected_name =  $request->input('suspected_name');
    

            $corpse->dob =  $request->input('dob');
            $corpse->death_date =  $request->input('death_date');

            $corpse->sex =  $request->input('sex');
            $corpse->nationality =  $request->input('nationality');
            $corpse->address =  $request->input('address');
            $corpse->station_id =  $request->input('corpse_stn_id');
            $div_id = Station::findOrFail($corpse->station_id);

            $corpse->division_id = $div_id->division_id;

           $corpse->dr_name = $this->test_input( $request->input('dr_name'));
           $corpse->dr_contact =  $request->input('dr_contact');


           $corpse->next_of_kin =  $request->input('next_of_kin');
           $corpse->next_of_kin_contact =  $request->input('next_of_kin_contact');
           $corpse->next_of_kin_email =  $request->input('next_of_kin_email');

            $corpse->parish = $div_id->division->parish->id;
            $corpse->pickup_date =  $request->input('pickup_date');
            $corpse->pickup_location =  $request->input('pickup_location');
            $corpse->type_death =  $request->input('type_death');
            $corpse->manner_id =  $request->input('manner_death');
            $corpse->anatomy_id =  $request->input('anatomy');
            $corpse->condition_id =  $request->input('condition');
            $corpse->finger_print =  $request->input('finger_print');
            $corpse->finger_print_date =  $request->input('finger_print_date');
            $corpse->gazetted =  $request->input('gazetted');
            $corpse->gazetted_date =  $request->input('gazetted_date');
            $corpse->volume_no = $request->input('volume_no');
 
            if($request->input('buried')!=''){
                $corpse->buried =  $request->input('buried');
            }else{
                $corpse->buried ="No";
            }
            $corpse->burial_date =  $request->input('burial_date');
            $corpse->postmortem_status =  $request->input('postmortem_status');
            $corpse->postmortem_date =  $request->input('postmortem_date');
            $corpse->funeralhome_id =  $request->input('funeralhome_id');
            $corpse->pathlogist =  $request->input('pathlogist');

            $corpse->cause_of_Death =  $request->input('cause_of_Death');

            $corpse->modified_by  = auth()->user()->id;
               try{
                 $corpDate =   $corpse->update();
                             $this->clearCaches();
               }
                catch (\Throwable $th) {
                    $error_array = ['Error, occurred while updating !'];
                }

          
         
              // try{  
                   
                    $dna =  Dna::findOrFail($corpse->getDna->id);
                    $dna->dna  = $request->input('dna'); 
                    $dna->dna_request_date = $request->input('dna_date');
                    $dna->dna_result_date = $request->input('dna_result_date');
                    $dna->dna_result = $request->input('dna_result');
                    $dna->update();                 
                //   }
                //    catch (\Throwable $th) {
                //     return   $error_array = ['Error, occurred while updating Dna !'];
                //    }





                 try{  
                   
                    $summaryUpdate =  Occurrence::findOrFail($corpse->occurrence->id);
                    $summaryUpdate->summary= $request->input('summary');
                    $summaryUpdate->update();
                                 
                  }
                   catch (\Throwable $th) {
                    return   $error_array = ['Error, occurred while updating Occurrence !'];
                   }

            
            $corpseUpdated =   Corpse::findOrFail( $request->input('id'));
         
            $success_output = '<div class="alert alert-success"> Updated Sucessfully! </div>';
            $data = array(
                "id" => $corpse->id,
                "type" => 'Updated',
                "first_name" => $corpse->first_name,
                "last_name" => $corpse->last_name,
                "division" => $corpse->station->division->division,
                "parish" => $corpse->station->division->parish->parish ,
                "user" => auth()->user()->email
            );

            $sendTo = User::whereHas('roles', function ($query) {
                $query->where('name', '=', 'superAdmin');
            })->get();
          
            try{
                if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                    // return back();
                }
            }
            catch (\Throwable $th) {
                $error_array = ['Your info update. However  we could not establish connection dispatch notification !'];
             }

            try {
                if ($corpse->pauper_burial_approved == 'Processing') {
                    event(new pauperBurialRequest($sendTo, $corpseUpdated));
                }
            } catch (\Throwable $th) {
                $error_array = ['Your Info Updated. However we could not establish connection dispatch email service!'];
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }












    public function callx()
    {
        $corpse = Corpse::all();
        return view('corpses/task', compact($corpse));
    }



    /**
     * Show the form for creating a new Corpse.
     *
     * @return Response
     */
    public function create()
    {
        $funeralhomes =  cache()->remember('Caches_key_CreateCorpseFuneralHome',Session::get('caches_time'), function () {
            return  Funeralhome::get();
        });
        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){  
           $stations = cache()->remember('Caches_key_CreateCorpseStations',Session::get('caches_time'), function () use( $auth_user_div_id) {
            return   Station::where('division_id', $auth_user_div_id)->get();
        });
        }else{
            $stations = cache()->remember('Caches_key_CreateCorpseStations',Session::get('caches_time'), function () {
                return   Station::get(); 
            });
        }
        $conditions= cache()->remember('Caches_key_corpse_create_Condition',Session::get('caches_time'), function () {
            return Condition::get();   
        });  
 
        $manners= cache()->remember('Caches_key_CreateCorpseManners',Session::get('caches_time'), function () {
            return Manner::get();  
        });   

        $anatomies= cache()->remember('Caches_key_corpse_create_Anatomy',Session::get('caches_time'), function () {
            return Anatomy::get();  
        });     


        $ranks = cache()->remember('cache_key_RanksCreateCorpse',Session::get('caches_time'), function () {
            return Rank::get();  
        });
        return view('corpses.create', compact('funeralhomes', 'ranks','stations','conditions','manners','anatomies'));
    }





    /**
     * Store a newly created Corpse in storage.
     *
     * @param CreateCorpseRequest $request
     *
     * @return Response
     */




    public function notifications()
    {
        return auth()->user()->unreadNotifications->where('type', 'App\Notifications\newCorpseNotification')->all();
        //  return  auth()->user()->unreadNotifications;
    }



    public function markAsRead(Request $request)
    {
        $mark = auth()->user()->unreadNotifications->where('type', 'App\Notifications\newCorpseNotification')->all();
        foreach ($mark as  $note) {
            if ($note->id == $request->not_id) {
                return    $note->update(['read_at' => now()]);
            }
        }
        //  return  auth()->user()->unreadNotifications->findOrFail($request->not_id)->markAsRead();
    }

    public function readNewCorpse($id)
    {     // i changed the corpses find by id to read the last unread id
        $corpses =  auth()->user()->readNotifications->where('id', $this->test_input( $id));// Corpse::findOrFail([$id]);

        return view('/readNewCorpseNotify')->withCorpses($corpses);
    }



    public function markAllNewCorpseNotifyAsRead(Request $request)
    {
        return  auth()->user()->unreadNotifications->where('type', 'App\Notifications\newCorpseNotification')->markAsRead();
        //return  auth()->user()->unreadNotifications->markAsRead();
    }



    public function allReadCorpseNofication()
    {
        $corpses = auth()->user()->readNotifications;
        $stations = Station::get();
        return view('/allReadCorpseNofication')->withCorpses($corpses)->withStations($stations);
    }



    public function store(Request $request)
    {

    }


    /**
     * Display the specified Corpse.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $corpse =  Corpse::findOrFail( $this->test_input($id));
        // $investigators= Investigator::where('investigators.corpse_id',$corpse->id)->get();
        if (empty($corpse)) {
            return redirect(route('corpses.index'))->with('error', 'Corpse Not Found!');
        }
        return view('corpses.show')->withCorpse($corpse);
    }

    /**
     * Show the form for editing the specified Corpse.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $corpse = Corpse::findOrFail( $this->test_input($id));

        if (empty($corpse)) {
            return redirect()->with('error', 'Corpse Not Found!');
        }
        $funeralhomes =  cache()->remember('Caches_key_EditCorpseFuneralHome',Session::get('caches_time'), function () {
            return  Funeralhome::get();
        });


        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){  
           $stations = cache()->remember('Caches_key_EditCorpseStations',Session::get('caches_time'), function () use( $auth_user_div_id) {
            return   Station::where('division_id', $auth_user_div_id)->get();
        });
        }else{
            $stations = cache()->remember('Caches_key_EditCorpseStations',Session::get('caches_time'), function () {
                return   Station::get(); 
            });
        }


        $investigators = Investigator::where('corpse_id', '=', $this->test_input( $id))->get();
        $conditions= cache()->remember('Caches_key_corpse_edit_Condition',Session::get('caches_time'), function () {
            return Condition::get();   
        });  

         
        $manners= cache()->remember('Caches_key_EditCorpseManners',Session::get('caches_time'), function () {
            return Manner::get();  
        });  

        $anatomies= cache()->remember('Caches_key_corpse_edit_Anatomy',Session::get('caches_time'), function () {
            return Anatomy::get();   
        });     
        $ranks = cache()->remember('Caches_key_RanksEditeCorpse',Session::get('caches_time'), function () {
            return Rank::get(); // Rank::paginate(10); 
        });
        $summary= Occurrence::where('corpse_id', $id)->get();
        return view('corpses.edit', compact('corpse','summary','funeralhomes', 'ranks','stations','conditions','manners','anatomies','investigators'));
      
    }

    /**
     * Update the specified Corpse in storage.
     *
     * @param int $id
     * @param UpdateCorpseRequest $request
     *
     * @return Response
     */
    public function update($id,  Request $request)
    {
        $corpse =  Corpse::finfOrFail( $this->test_input($id));

        if (empty($corpse)) {
            return redirect()->with('error', 'Corpse Not Found!');
        }

        try{
                $corpse->update();
            }
        catch (\Throwable $th) {
        return ['error'=>' Something occurred while updating !'];
        }

        $data = array(
            "id" => $corpse->id,
            "type" => 'Updated',
            "first_name" => $corpse->first_name,
            "last_name" => $corpse->last_name,
            "division" => $corpse->station->division->division,
            "parish" =>  $corpse->station->division->parish->parish ,
            "user" => auth()->user()->email
        );

        $sendTo = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'superAdmin');
        })->get();

        try{
            if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                return back();
            }
            }
            catch (\Throwable $th) {
            return ['error'=>' Something occurred while sending notification!'];
            }


        return redirect('/corpses')->with('success', 'Corpse updated successfully');
    }



















    // public function updateNotifications()
    // {

    //     return auth()->user()->unreadNotifications->where('type', 'App\Notifications\updateCorpseNotification')->all();
    // }



    // public function updateMarkAsRead(Request $request)
    // {
    //     $mark = auth()->user()->unreadNotifications->where('type', 'App\Notifications\updateCorpseNotification')->all();
    //     foreach ($mark as  $note) {
    //         if ($note->id == $request->not_id) {
    //             return    $note->update(['read_at' => now()]);
    //         }
    //     }
    //     return true;
    // }

    // public function  updateReadNewCorpseNotify($id)
    // {
    //     $corpses = Corpse::findOrFail([$id]);
    //     return view('/updateReadNewCorpseNotify')->withCorpses($corpses);
    // }

    // public function  updateMarkAllNewCorpseNotifyAsRead()
    // {
    //     return  auth()->user()->unreadNotifications->where('type', 'App\Notifications\updateCorpseNotification')->markAsRead();
    //     // return  auth()->user()->unreadNotifications->markAsRead();
    // }



    // public function updateAllReadCorpseNofication()
    // {
    //     $corpses = auth()->user()->readNotifications;
    //     $stations = Station::get();
    //     return view('/updateAllReadCorpseNofication')->withCorpses($corpses)->withStations($stations);
    // }


















    //////////////////////////////////////////////////////




    /**

     * Create a new controller instance.

     *

     * @return void

     */
    


    public function messageSuperAdmin(Request $request)

    {

         $validation = Validator::make($request->all(), [
            'subject' => 'required|min:3|max:90', 
            'message' => 'required|min:7|max:500',           
            'corpse_id' => 'required'
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {



            $messageSuperAdmin = new Message();
            $messageSuperAdmin->user_id = auth()->user()->id;        
            $messageSuperAdmin->corpse_id =   $this->test_input( $request->input('corpse_id'));
            $messageSuperAdmin->subject =    $this->test_input( $request->input('subject'));
            $messageSuperAdmin->message =   $this->test_input($request->input('message')); 
        try{
            $messageSuperAdmin->saveOrFail();
            $success_output= " Message sent successfully";
            }
            catch (\Throwable $th) {
                $error_arra=' Something occurred while sending message  !';
            }
    
            $sendTo = User::whereHas('roles', function ($query) {
                $query->where('name', '=', 'superAdmin');
            })->get();
    
            $data = array(
                'id' => $messageSuperAdmin->corpse_id,
                'type' => 'message',
                "from" => auth()->user()->email
            );
    
            try{
                if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                    
                }
             }
            catch (\Throwable $th) {
                $error_arra=' Something occurred while retrieving record!';
            }
    
         
    
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
    
        echo json_encode($output);
    
  
    }
















    public function taskPost(Request $request)

    {

        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->address_to_id =    $this->test_input( $request->input('address_to_id'));
        $task->corpse_id =   $this->test_input( $request->input('corpse_id'));
        $task->task =   $this->test_input($request->input('task'));
        $task->modify_by = 0;
        $error_array = '';
        $error_notification = '';
        $success_output = '';
    try{
        $task->saveOrFail();
        $success_output = '<div class="alert alert-success">  Task sent sucessfully! </div>';

        }
        catch (\Throwable $th) {
            $error_array ='<div class="alert alert-danger"> Something occurred while saving Task! </div>';
        // return ['error'=>' Something occurred while saving task !'];
        }
        $sendTo = User::where('id', '=', $task->address_to_id)->get();
        $data = array(
            'id' => $task->corpse_id,
            'type' => 'task',
            "from" => auth()->user()->email
        );

        try{
            if (\Notification::send($sendTo, new newCorpseNotification($data))) {
                return back();
            }
         }
        catch (\Throwable $th) {
            $error_notification =  '<div class="alert alert-info">Task sent. But something occurred while sending notification </div>';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'error_notification'=>$error_notification
        );
    
        return   json_encode($output);
       // return  response()->json(['Task notification sent successfully.']);
    }
    //////////////////////////////////////////////////////


    


    public function getAllMessages(Request $request)

    {
        try{
        $data = DB::table('messages')->where('corpse_id',$this->test_input( $request->input('corpse_id')))->orderBy('created_at', 'desc')
            ->get();
        }
        catch (\Throwable $th) {
           return ['error'=>' Something occurred while retrieving messages!'];
        }
        return  response()->json($data);
    }

    public function getTasks(Request $request)

    {
        try{
        $data = DB::table('tasks')->where('corpse_id',$this->test_input( $request->input('corpse_id')))->orderBy('created_at', 'desc')
            ->get();
        }
        catch (\Throwable $th) {
           return ['error'=>' Something occurred while retrieving tasks!'];
        }
        return  response()->json($data);
    }





    public function getSummary(Request $request)

    {
        try{
        $data = DB::table('occurrences')->where('corpse_id',$this->test_input( $request->input('corpse_id')))->orderBy('created_at', 'desc')
            ->get();
        }
        catch (\Throwable $th) {
           return ['error'=>' Something occurred while retrieving summary!'];
        }
        return  response()->json($data);
    }




    public function updateInvest(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'investigator_first_name' => 'required|min:2|max:15',
            'investigator_last_name' => 'required|min:2|max:15',
            'rank_id' => 'required',
            'assign_date' => 'required|date',
            'contact_no' => 'min:10|max:13',
            'regNum' => 'required|min:3|max:6',
            'station_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

             try {
            $investigator = Investigator::findOrFail($request->input('id')); //Get role specified by id

            $investigator->investigator_first_name =  $this->test_input($request->input('investigator_first_name'));
            $investigator->investigator_last_name = $this->test_input( $request->input('investigator_last_name'));
            $investigator->assign_date = $this->test_input($request->input('assign_date'));
            $investigator->contact_no =  $this->test_input($request->input('contact_no'));
            $investigator->rank_id = $this->test_input($request->input('rank_id'));
            $investigator->station_id =  $this->test_input($request->input('station_id'));
            $investigator->regNum = $this->test_input( $request->input('regNum'));

            // $investigator->user_id = auth()->user()->id;
            $investigator->modified_by =  auth()->user()->id;
            $investigator->update();
            $success_output = '<div class="alert alert-success"> Updated Sucessfully! </div>';
             }
            catch (\Throwable $th) {
                $error_array =['Error, Something occurred while updating!'];
            }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }












    public function reassign(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'investigator_first_name' => 'required|min:2|max:15',
            'investigator_last_name' => 'required|min:2|max:15',
            'rank_id' => 'required',
            'assign_date' => 'required|date',
            'contact_no' => 'min:10|max:13',
            'regNum' => 'required|min:3|max:6',
            'station_id' => 'required',
            'corpse_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        } else {

            try {
            $investigator = new Investigator(); //Get role specified by id

            $investigator->investigator_first_name =  $this->test_input($request->input('investigator_first_name'));
            $investigator->investigator_last_name =  $this->test_input($request->input('investigator_last_name'));
            $investigator->assign_date = $this->test_input($request->input('assign_date'));
            $investigator->contact_no = $this->test_input( $request->input('contact_no'));
            $investigator->rank_id = $this->test_input($request->input('rank_id'));
            $investigator->station_id =  $this->test_input($request->input('station_id'));
            $investigator->regNum =  $this->test_input($request->input('regNum'));
            $investigator->corpse_id =$this->test_input( $request->input('corpse_id'));
            $investigator->user_id = auth()->user()->id;
            $investigator->modified_by =  auth()->user()->id;

            $investigator->save();

            $success_output = '<div class="alert alert-success"> Saved Sucessfully! </div>';
             }
            catch (\Throwable $th) {
                $error_array =['Error, Something occurred while saving!'];
            }

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }












    public function getEditInvest_id(Request $request)
    {
        try{
        $data = Investigator::where('id', $this->test_input(  $request->input('corpse_id')))->orderBy('created_at', 'desc')->get();
        }
        catch (\Throwable $th) {
           return ['error'=>' Something occurred while retrieving record!'];
        }
        return  response()->json($data);
    }


    public function getInvestigator(Request $request)

    {
        $data = '';
        try{
        $datax = Investigator::where('corpse_id',  $this->test_input(  $request->input('corpse_id')))->orderBy('created_at', 'desc')->get();
        }
        catch (\Throwable $th) {
        return ['error'=>' Something occurred while retrieving record!'];
        }
        // /investigators/'.$io->id.'/edit
        foreach ($datax as $io) {
            $data .=  '<p> No. ' . $io->regNum . '  ' . $io->rank->rank . '  ' . $io->investigator_first_name . '  ' . $io->investigator_last_name . ',
               stationed at  ' . $io->station->station . ' in ' . $io->station->division->division . ' division contact #: ' .
                $io->contact_no . ' assigned date ' . $io->assign_date . ' <a  onclick="getEditInvest_id(' . $io->id . ')" href="#" class="btn editInvestment  
                btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
              
             if(auth()->user()->hasRole('SuperAdmin')){
                $data.='<a  onclick="deleteInvestigator(' . $io->id . ')" href="#" class="btn editInvestment  btn-default btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>'; 
             }
             $data.= '</p> <br> ';

        }

        //dd($data);

        return response()->json($data);
    }






    /**
     * Remove the specified Corpse from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
     
        $corpse =  Corpse::findOrFail( $this->test_input($id));
        if (empty($corpse)) {
            return redirect('/corpses')->with('error', 'Corpse Not Found!');
        } 
     
     
        try{ 
            Storage::disk('public')->delete('/'.$corpse->corpse_image);         
            $corpse->delete($id);
          }
    catch (\Throwable $th) {
       return ['error'=>' Something occurred while deleting record!'];
    }
        return redirect('/corpses')->with('success', 'Corpse deleted successfully.');
    }
}
