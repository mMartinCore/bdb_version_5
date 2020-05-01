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
use Session;
use  Charts;
use App\Parish;
use App\Http\Controllers\mysql_real_escape_string;
//use Illuminate\Notifications\Notification;
use  Notification;
use Illuminate\Support\Facades\DB;

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











    public function index()
    {
        // $corpses = Corpse::orderBy('created_at', 'desc')->get();
        $funeralhomes = Funeralhome::get();
        $auth_user_div_id= auth()->user()->station->division->id  ;
        $parishes=Parish::get();
        if(!auth()->user()->hasRole('SuperAdmin')){
           $stations = Station::where('division_id', $auth_user_div_id)->get();
        }else{
            $stations = Station::get();
        }


        if(!auth()->user()->hasRole('SuperAdmin')){
            $divisions = Division::where('id', $auth_user_div_id)->get();
         }else{
            $divisions = Division::get();
         }

         $conditions= Condition::get();
         $manners= Manner::get();
         $anatomies= Anatomy::get();
         $ranks =  Rank::all();
         return view('corpses.index', compact('funeralhomes', 'parishes','stations','conditions','manners','anatomies','divisions'));
     
        // return view('corpses.index');//->with($corpses);
    }


    public function export()
    {
        $da = array();
      //  $newExportList=array();
        $da =Session::get('getExportList');


        // foreach ($da as  $corpse) {
        //     $storagedays = $this->storageday($corpse->pickup_date, $corpse->burial_date);
        //     if ($storagedays >= 30) {

        //         $storagedays =  $storagedays;

        //         if ($storagedays > 30) {

        //             $excess = $storagedays - 30;


        //             if ($excess > 0) {
        //             } else {
        //                 $excess = 0;
        //             }
        //         } else {
        //             $excess = 0;
        //         }

        //     } elseif ( $storagedays <= 30) {
        //         $excess = 0;
        //         $storagedays = $storagedays;
        //     }


        //     if ($corpse->first_name == "Unidentified") {

        //         if ($corpse->suspected_name != '')
        //             $name = '*' . $corpse->suspected_name . '*';
        //         else {
        //             $name = 'Unidentified';
        //         }
        //     } else {
        //         $name = $corpse->first_name . ' ' . $corpse->middle_name . ' ' . $corpse->last_name;
        //     }

        //     $newExportList[]= [$corpse->id , $name, $corpse->death_date, $corpse->pickup_date , $corpse->anatomy,
        //                     $corpse->postmortem_status, $corpse->division, $corpse->pauper_burial_requested ,
        //                     $corpse->pauper_burial_approved,  $corpse->burffied,  $storagedays,  $excess
        //                       ];






        //         //  $newExportList[]= array(
        //         //                 'Id'=>$corpse->id ,
        //         //                 'Name'=> $name,
        //         //                 'Date of Death'=>$corpse->death_date,
        //         //                 'Pickup Date'=> $corpse->pickup_date ,
        //         //                 'Anatomy'=> $corpse->anatomy,
        //         //                 'Postmortem Status'=> $corpse->postmortem_status,
        //         //                 'Division'=> $corpse->division,
        //         //                 'Pauper burial request '=>$corpse->pauper_burial_requested ,
        //         //                 'Pauper burial request Approved'=>  $corpse->pauper_burial_approved,
        //         //                 'Buried'=> $corpse->buried,
        //         //                 'Storagedays' =>  $storagedays,
        //         //                 'Excess'=> $excess
        //         //                );
        //    }
        //   $newExportList=(object)  $newExportList ;


        //  // dd($newExportList, $da);


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
                    $name = '*' . $corpse->suspected_name . '*';
                else {
                    $name = 'Unidentified';
                }
            } else {
                $name = $corpse->first_name . ' ' . $corpse->middle_name . ' ' . $corpse->last_name;
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

    else  if(auth()->user()->hasRole('view')){
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
        </div>'
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
        $corpses = Corpse::where('pauper_burial_approved', 'Processing')->where('division_id', auth()->user()->station->division->id  )
            ->paginate(10);
        }else {
            $corpses = Corpse::where('pauper_burial_approved', 'Processing')
            ->paginate(10);
        }
        $listType="Request";
        return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }



    public function notApprove()
    {
        if(!auth()->user()->hasRole('SuperAdmin')){
        $corpses = Corpse::where('pauper_burial_approved', 'No')->where('division_id', auth()->user()->station->division->id  )
            ->paginate(10);
        }else{
            $corpses = Corpse::where('pauper_burial_approved', 'No')
            ->paginate(10);
        }
        $listType="Request Denied";
        return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }


    public function noRequest()
    {     if(!auth()->user()->hasRole('SuperAdmin')){
        $corpses = Corpse::where('pauper_burial_approved', 'No-Request')->where('division_id', auth()->user()->station->division->id  )->paginate(5);
    }else {
        $corpses = Corpse::where('pauper_burial_approved', 'No-Request')->paginate(10);
    }
    $listType="No-Request";
    return view('corpses.approve')->withCorpses($corpses)->withListType($listType);
    }





    public function thirtyDaylist()
    {
        if(!auth()->user()->hasRole('SuperAdmin')){
            $corpses = Corpse::where('division_id', auth()->user()->station->division->id)->paginate(10);
        }else{
            $corpses = Corpse::paginate(10);
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
            'task' => 'required'
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


    public function search($arg)
    {
        // $corpses =  DB::select(DB::raw("SELECT * FROM corpses WHERE $arg like '%$arg%' and "));
    }


    public function getCorpse(Request $request)
    {

       $auth_user_div_id= auth()->user()->station->division->id  ;
       $auth_user_divSingle ="where `users`.division_id = $auth_user_div_id ";

       $auth_user_divMult =" and `users`.division_id = $auth_user_div_id";
        $data = $request->except('_token');
        $except ='';
        $query = '';
        $count = 0;
        $search= false;
        $page = 0;
        $pagination_link = '';
        $total_records =0;
        $record_per_page=1;
        $total_recordsFromSearch=0;
        $total_recordsFromSearchCnt=0;
        $total_records= DB::table('corpses')->count();
        $order_by_last_name = 'asc';

        foreach ($data as $key => $value) {
            $value =$this->test_input( $value);

            if($key=='order_by_last_name') {

                if($value!='') {
                      $order_by_last_name =$value;
                }else   {
                $order_by_last_name = 'asc';
                }

             }



            if($key=='page' ||$key=='order_by_last_name')
            {  }
            else
            {       $search=true;
                    if ($value != '' && $count > 0 && $key != 'regNum') {
                        $this->countVal = 1;
                        $this->antherVariable = 2;
                        if ($key == 'pauper_burial_approved' || $key == 'buried' || $key == 'division_id' ||  $key == 'anatomy_id' ||  $key == 'parish' || $key == 'funeralhome_id' ||  $key == 'station_id' ||   $key == 'sex' || $key == 'death_date' || $key == 'pickup_date' ||  $key == 'pauper_burial_requested_date' || $key == 'postmortem_date' || $key == 'burial_date') {
                            $query .= " and corpses.$key ='$value'";
                        } else {

                            $query .= " and  corpses.$key like  '%$value%'";
                        }
                    } else  if ($value != '' && $count == 0 && $key != 'regNum') {
                        $count = $count + 1;
                        $this->countVal = 1;
                        $this->antherVariable = 1;
                        if ( $key == 'pauper_burial_approved' || $key == 'buried' || $key == 'division_id' ||  $key == 'anatomy_id' ||  $key == 'parish' || $key == 'funeralhome_id' ||  $key == 'station_id' ||  $key == 'sex' || $key == 'death_date' || $key == 'pickup_date' || $key == 'pauper_burial_requested_date' || $key == 'postmortem_date' || $key == 'burial_date') {
                            $query .= " where corpses.$key = '$value'";
                        } else {

                            $query .= " where corpses.$key like '%$value%' ";
                        }
                    }

                    //  I TEST FOR REG NUM HERE
                    if ($key == 'regNum' && $value != '') {
                        //$this->regNunWithOther = " and $key ='$value' ";
                        $this->regNo = " $key ='$value'";
                    }
           }

                if($key=='page')
                {
                        $intVal=(int) $value;

                            if($intVal >1) {
                            $page =$intVal;
                            } else {

                                $page = 1;
                            }
                }else {

                     $page = 1;
                }






        }






        $start_from = ($page - 1) *    $record_per_page;
        if (  $start_from <0) {
            $start_from=0;
        }


      // try {

               if(!auth()->user()->hasRole('SuperAdmin')){
                    if ($this->regNo != '') {
                        if ($this->countVal == 0) {
                            //HERE IS JUST run REGNUM ONLY
                            $corpses =  DB::select(DB::raw("SELECT DISTINCT  divisions.division, corpses.* FROM corpses INNER join `divisions` on `divisions`.id = `corpses`.division_id
                            INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                            INNER join `users` on `divisions`.id = `users`.division_id  where `users`.division_id= $auth_user_div_id
                            AND $this->regNo  ORDER BY created_at  LIMIT $start_from, $record_per_page "));
//0

                            $total_recordsFromSearch  =  DB::select(DB::raw("SELECT DISTINCT  COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses
                            INNER join `divisions` on `divisions`.id = `corpses`.division_id
                            INNER join `users` on `divisions`.id = `users`.division_id
                            INNER join `investigators` on `investigators`.corpse_id = `corpses`.id where $this->regNo AND  `users`.division_id= $auth_user_div_id GROUP BY  `corpses`.id"));


                        } else if ($this->antherVariable == 1) {
                            $corpses =
                                DB::select(DB::raw("SELECT DISTINCT  divisions.division ,corpses.* FROM corpses
                                INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                                INNER join `users` on `divisions`.id = `users`.division_id  $query
                                AND  $this->regNo   $auth_user_divMult  ORDER BY created_at  LIMIT $start_from, $record_per_page "));

//1
                                $total_recordsFromSearch  = DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search  FROM corpses
                                INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                INNER join `users` on `divisions`.id = `users`.division_id
                                INNER join `investigators` on `investigators`.corpse_id = `corpses`.id   $query AND  `users`.division_id= $auth_user_div_id  AND   $this->regNo  "));


                        } elseif ($this->antherVariable == 2) {

 //2
                            $corpses =
                                DB::select(DB::raw("SELECT DISTINCT  divisions.division ,corpses.* FROM corpses
                                INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                                INNER join `users` on `divisions`.id = `users`.division_id
                                $query and $this->regNo   $auth_user_divMult  ORDER BY created_at  LIMIT $start_from, $record_per_page"));

                                $total_recordsFromSearch  = DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses
                                INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                INNER join `users` on `divisions`.id = `users`.division_id
                                INNER join `investigators` on `investigators`.corpse_id = `corpses`.id $query AND  `users`.division_id= $auth_user_div_id and $this->regNo"));


                        }
                    } else {
  //3
                      $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                                                           INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                                           INNER join `users` on `divisions`.id = `users`.division_id   $query
                                                           AND  `users`.division_id= $auth_user_div_id  ORDER BY created_at  LIMIT $start_from, $record_per_page"));

                            $total_recordsFromSearch =  DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses
                            INNER join `divisions` on `divisions`.id = `corpses`.division_id
                            INNER join `users` on `divisions`.id = `users`.division_id  $query
                            AND  `users`.division_id= $auth_user_div_id "));



                  }


        } else {

            if ($this->regNo != '') {
                if ($this->countVal == 0) {
                    //HERE IS JUST run REGNUM ONLY
                    $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division, corpses.* FROM corpses
                     INNER join `divisions` on `divisions`.id = `corpses`.division_id
                     INNER join `investigators` on `investigators`.corpse_id = `corpses`.id where $this->regNo  ORDER BY created_at LIMIT $start_from, $record_per_page"));


                    $total_recordsFromSearch  =  DB::select(DB::raw("SELECT DISTINCT  COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses
                    INNER join `divisions` on `divisions`.id = `corpses`.division_id
                    INNER join `investigators` on `investigators`.corpse_id = `corpses`.id where $this->regNo GROUP BY  `corpses`.id"));




                } else if ($this->antherVariable == 1) {

                    $corpses =
                        DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                        INNER join `divisions` on `divisions`.id = `corpses`.division_id
                        INNER join `investigators` on `investigators`.corpse_id = `corpses`.id   $query AND  $this->regNo  ORDER BY created_at  LIMIT $start_from, $record_per_page "));

                        $total_recordsFromSearch  = DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search  FROM corpses
                        INNER join `divisions` on `divisions`.id = `corpses`.division_id
                        INNER join `investigators` on `investigators`.corpse_id = `corpses`.id   $query AND  $this->regNo  "));




                } elseif ($this->antherVariable == 2) {

                    $corpses =
                        DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                        INNER join `divisions` on `divisions`.id = `corpses`.division_id
                        INNER join `investigators` on `investigators`.corpse_id = `corpses`.id $query and $this->regNo  ORDER BY created_at   LIMIT $start_from, $record_per_page "));

                        $total_recordsFromSearch  = DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses
                        INNER join `divisions` on `divisions`.id = `corpses`.division_id
                        INNER join `investigators` on `investigators`.corpse_id = `corpses`.id $query and $this->regNo"));



                }
            } else {

               $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses INNER join `divisions` on `divisions`.id = `corpses`.division_id $query
                   ORDER BY  last_name $order_by_last_name  LIMIT $start_from, $record_per_page"));
               $total_recordsFromSearch =  DB::select(DB::raw("SELECT DISTINCT COUNT(`corpses`.id) AS cntTotalResult_search FROM corpses INNER join `divisions` on `divisions`.id = `corpses`.division_id $query"));


            }


        }









        // } catch (\Throwable $th) {
        //     return $except = 'Something occurred while retriving record !';
        // }

        /*
        DB::table('corpses')
        ->select(DB::raw('count(*) as user_count, id,*'))->
        $query->groupBy('id')->paginate(3);*/

        //DB::table('corpses')->$query->get()->paginate(1);
        // Corpse::where('id','!=',null).$query->paginate(1);
        // DB::select( DB::raw("SELECT * FROM corpses $query ") );
        // -- unidentified = '$request->unidentified'
        // --     and (first_name = '' OR first_name like '%$request->first_name%')
        // --     and (middle_name ='' OR middle_name like '%$request->middle_name%')
        // --     and (last_name= '' OR last_name like '%$request->last_name%')
        // --     and (sex ='$request->sex' OR sex ='')
        // --  OR pauper_burial_requested_date ='$request->pauper_burial_requested_date'
        // --  OR pickup_date = '$request->pickup_date'
        // --   OR pickup_location = '$request->pickup_location'
        // --    OR regNum ='$request->regNum'
        // --    OR funeralhome_id ='$request->funeralhome_id'
        // --    OR anatomy ='$request->anatomy'
        // --      unidentified = '$request->unidentified'
        // --    OR first_name = '$request->first_name
        // --    OR middle_name ='$request->middle_name'
        // --    OR last_name='$request->last_name'
        // --    OR pauper_burial_requested_date= '$request->pauper_burial_requested_date'
        // --    OR pickup_date = '$request->pickup_date'
        // --    OR pickup_location = '$request->pickup_location'
        // --    OR regNum ='$request->regNum'
        // --    OR funeralhome_id ='$request->funeralhome_id'
        // --    OR anatomy ='$request->anatomy'
        // --    OR death_date = '$request->death_date'




        // $corpses = DB::table('corpses')->where('unidentified',$request->unidentified)
        // ->where('first_name','like','%'.$request->first_name.'%')
        // ->orWhere('first_name','like','%'.$request->first_name.'%')

        // ->where('middle_name','like','%'.$request->middle_name.'%')
        // ->orWhere('middle_name','like','%'.$request->middle_name.'%')

        // ->where('last_name','like','%'.$request->last_name.'%')
        // ->orWhere('last_name','like','%'.$request->last_name.'%')







        // ->orWhere('pauper_burial_requested_date','like', $request->pauper_burial_requested_date)

        // ->orWhere('death_date','like', $request->death_date)

        // ->orWhere('pickup_date','like',$request->pickup_date)

        // ->orWhere('pickup_location','like','%'.$request->pickup_location.'%')

        // ->orWhere('anatomy','like','%'. $request->anatomy.'%')

        // ->orWhere('regNum','like','%'.$request->regNum.'%')

        // ->orWhere('funeralhome_id','like','%'. $request->funeralhome_id.'%')

        // ->orWhere('unidentified','like','%'.$request->unidentified.'%')

        // ->where('sex', $request->sex)
        // ->orWhere('sex', $request->sex)


        // ->get();

        //     $corpses = Corpse::orderBy('created_at', 'desc')->get();

        $table = '';
        $count = 0;
        $storagedays = '';
        $excess = 0;
        // dd($corpses);
        $name = '';




foreach ($total_recordsFromSearch as $key => $cnt) {
    $total_recordsFromSearchCnt= (int)  $cnt->cntTotalResult_search;
}




        foreach ($corpses as $key => $corpse) {

            $storagedays = $this->storageday($corpse->pickup_date, $corpse->burial_date);
            if ($storagedays >= 30 && $corpse->burial_date == '') {

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
                    $name = '*' . $corpse->suspected_name . '*';
                else {
                    $name = 'Unidentified';
                }
            } else {
                $name = $corpse->first_name . ' ' . $corpse->middle_name . ' ' . $corpse->last_name;
            }

             $anatomy= Anatomy::findOrFail($corpse->anatomy_id);
            if(auth()->user()->hasRole('SuperAdmin')){
                // $del='SuperAdmin|Admin|viewer|write';
                $table .= '<tr>
                <td>' .'<a class="btn showViewModal btn-success btn-xs"   onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
                .'<td>' . $name . '</td>
                .<td>' . $corpse->death_date . '</td>
                .<td>' . $corpse->pickup_date . '</td>
                .<td>' .$anatomy->anatomy  . '</td>
                .<td>' . $corpse->postmortem_status . '</td>
                .<td>' . $corpse->division . '</td>
                .<td>' . $corpse->pauper_burial_requested . '</td>
                .<td>' . $corpse->pauper_burial_approved . '</td>
                .<td>' . $corpse->buried . '</td>
                .<td>' . $storagedays . '</td>
                .<td>' . $excess . '</td>
                .<td>
                <div class="btn-group no">
              <a href="corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
             '<a  href="#"  class="btn btn-danger  btn-xs " onclick="getId(' . $corpse->id . ')" >    <i class="glyphicon glyphicon-trash"></i></a>
                </div>'

            . '</td>
            </tr>';
        $count++;
    }else  if(auth()->user()->hasRole('Admin')){
        $table .= '<tr>
        <td>' .'<a  class="btn showViewModal btn-success btn-xs"  onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
        .'<td>' . $name . '</td>
        .<td>' . $corpse->death_date . '</td>
        .<td>' . $corpse->pickup_date . '</td>
        .<td>' . $anatomy->anatomy . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->division . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">'
        .'<a href="corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
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
        .<td>' . $anatomy->anatomy  . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->division . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">
        <a href="corpses/' . $corpse->id . '/edit" class="btn btn-primary btn-xs "><i class="glyphicon glyphicon-edit"></i></a>' .
    ' </div>'

    . '</td>
    </tr>';
$count++;
    }

    else  if(auth()->user()->hasRole('view')){
        $table .= '<tr>
        <td>' .'<a class="btn showViewModal btn-success btn-xs"   onclick="getViewId(' . $corpse->id . ')" > '.$corpse->id .' </a>'. '</td>'
        .'<td>' . $name . '</td>
        .<td>' . $corpse->death_date . '</td>
        .<td>' . $corpse->pickup_date . '</td>
        .<td>' .$anatomy->anatomy . '</td>
        .<td>' . $corpse->postmortem_status . '</td>
        .<td>' . $corpse->division . '</td>
        .<td>' . $corpse->pauper_burial_requested . '</td>
        .<td>' . $corpse->pauper_burial_approved . '</td>
        .<td>' . $corpse->buried . '</td>
        .<td>' . $storagedays . '</td>
        .<td>' . $excess . '</td>
        .<td>
        <div class="btn-group">
        </div>'
    . '</td>
    </tr>';
$count++;
    }



}



$pagination_link='';
//dd($page);
if(  $search==true || $page > 1 ){

    $total_pages = ceil($total_recordsFromSearchCnt /$record_per_page);

}else{

    $total_pages = ceil($total_recordsFromSearchCnt /$record_per_page);
}




if($page > 1){
    $pagination_link .= "<span class='pagination_link hover btn-xs btn btn-info' style='cursor:pointer; height:25px; width:35px; padding:5px; border:1px solid #ccc;' id='".(1)."'>
     First </span>";
}


if($page > 1){
    $pagination_link .= "<span class='pagination_link hover btn-xs btn btn-info' style='cursor:pointer; height:25px; width:35px; padding:5px; border:1px solid #ccc;' id='".($page-1)."'>
     Prev </span>";
}

for($i=1; $i<=$total_pages; $i++)
{
     if($page==$i)
     {
        $pagination_link .= "<a class=' active ></a>";
   }

     $pagination_link .= "<a class='pagination_link hover btn-xs btn btn-primary ' style='cursor:pointer; height:25px; width:35px; padding:5px; border:1px solid #ccc;' id='".$i."'> ".$i."</a>";
}

if( $i-1 >$page ){
    $pagination_link .= "<span class='pagination_link hover btn-xs btn btn-info' style='cursor:pointer; height:25px; width:35px;padding:5px; border:1px solid #ccc;' id='".($page + 1)."'>
     Next </span>";
}

if( $i-1 >$page ){
    $pagination_link .= "<span class='pagination_link hover btn-xs btn btn-info' style='cursor:pointer; height:25px; width:35px;padding:5px; border:1px solid #ccc;' id='".($i-1) ."'>
     Last </span>";
}






if($count<$record_per_page){
   $pageRemain= $record_per_page -$count;
    $countTotal =  $page *$record_per_page ;
    $count = $countTotal -  $pageRemain;
}else{
    $count =$count * $page;
}





Session::put('getExportList',$corpses);
$this->setExportList($corpses);
$this->getExportList();
        $data = array(
            'table' => $table,
            'cnt' => $count ,
            'search_Count_total'=>$total_recordsFromSearchCnt ,
            'pagination_link'=> $pagination_link,
            'error'=>$except ,
        );

       return response($data);
    }







    public function overThirtyDaysStats()
    {
        $pieChartData = $this->myChart();
        $total_Count_per_NotApproved = array();
        $total_per_division = array();
        $total_per_Div_NotBuried = array();
        $total_Count_per_Pending = array();
        $division_Name = array();
        $notBuriedDivNames = array();
        $burial_NotApprovedName = array();
        $pendingPostmortemName= array();

        foreach ($pieChartData['divisionName'] as  $Name) {
            if ($Name != '') {
                $division_Name[] = $Name;
            }
        }


        foreach ($pieChartData['total_Count_per_division'] as $key => $count) {

            $total_per_division[] = $count;
        }



        foreach ($pieChartData['notBuriedDivNames'] as  $divName) {
            if ($divName != '') {
                $notBuriedDivNames[] = $divName;
            }
        }

        foreach ($pieChartData['total_Count_per_NotBuried'] as  $cnt) {
            //  dd( $cnt);
            $total_per_Div_NotBuried[] = $cnt;
        }



        foreach ($pieChartData['pendingPostmortemName'] as  $pendingName) {
            if ($pendingName != '') {
                $pendingPostmortemName[] = $pendingName;
            }
        }
        foreach ($pieChartData['total_Count_per_Pending'] as  $cnxt) {
            $total_Count_per_Pending[] = $cnxt;
        }





        foreach ($pieChartData['burial_NotApprovedName'] as  $notApprovedName) {
            if ($notApprovedName != '') {
                $burial_NotApprovedName[] = $notApprovedName;
            }
        }

        foreach ($pieChartData['total_Count_per_NotApproved'] as  $cn) {
            $total_Count_per_NotApproved[] = $cn;
        }


        //    $divValue =$pieChartData['total_Count_per_division'];

        $chart = Charts::create('donut', 'highcharts')
            ->title('Bodies Over 30 Days per Division')
            ->labels($division_Name)
            ->values($total_per_division)
            ->dimensions(1000, 500)
            ->responsive(true);


        $bar = Charts::create('bar', 'highcharts')
            ->title('Not Buried per Division')
            ->elementLabel(' Total Bodies Not Buried')
            ->labels($notBuriedDivNames)
            ->values($total_per_Div_NotBuried)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);





        $pie = Charts::create('pie', 'google')
            ->title('Post Mortem Pending per Division')
            ->elementLabel(' Total Pending  Post Mortem per Division ')
            ->labels($pendingPostmortemName)
            ->values($total_Count_per_Pending)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);

        $notApproved_bar = Charts::create('donut', 'google')
            ->title(' Pauper s Burial Not Approved per Division')
            ->elementLabel('Not Approved per Division')
            ->labels($burial_NotApprovedName)
            ->values($total_Count_per_NotApproved)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);






        //$s=$this->divisionOverThirstyDays();

        $post_mortem_pending = $this->post_mortem_pending();
        $burial_request = $this->burial_request();
        $burial_NotApproved = $this->burial_NotApproved();
        $overThirtyDays = 0;
        $corpses = Corpse::whereDate('pickup_date', '!=', '')->get();
        foreach ($corpses as $corpse) {
            if ($this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30  ) {

                $overThirtyDays++;
                //$storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date) ,'Name'=> $corpse->first_name.'  '.$corpse->last_name );
            }
        }






        return View('/dashboard', compact('chart', 'bar', 'pie', 'notApproved_bar', 'overThirtyDays', 'post_mortem_pending', 'burial_request', 'burial_NotApproved'))->render();
    }





    public function divisionOverThirstyDays()
    {
        $corpses = Corpse::get();
        $overThirtyDays = 0;
        $dataCompact[] = null;
        $div[] = '';
        // $totalCountPerDiv[]='';
        // $divisionName[]='';
        // $notBuriedName[]='';
        // $totalCountNotBuriedCompact[]='';
        // $pendingPostmortemName[]='';
        // $ToatalPendingPostmortemCompact[]='';
        // $burial_NotApprovedName[]='';
        // $totalBurial_NotApprovedCompact[]='';


        $pendingPostmortem[] = null;
        $pendingPostmortemCompact[] = null;
        $burial_NotApproved[] = null;
        $burial_NotApprovedCompact[] = null;


        $notBuried[] = null;
        $notBuriedCompact[] = null;






        foreach ($corpses as $corpse) {



            if ($corpse->pauper_burial_approved == 'No') {
                $burial_NotApproved[$corpse->division_id] = $corpse->station->division->division;
                $burial_NotApprovedCompact[] =  array(
                    'id' => $corpse->id,
                    'division_id' => $corpse->division_id,
                    'Division' => $corpse->station->division->division,
                    'Days' => $days = $this->storageday($corpse->pickup_date, $corpse->burial_date),
                    'Name' => $corpse->first_name . '  ' . $corpse->last_name
                );
            }

            if ($corpse->postmortem_status == 'Pending') {
                $pendingPostmortem[$corpse->division_id] = $corpse->station->division->division;
                $pendingPostmortemCompact[] =  array(
                    'id' => $corpse->id,
                    'division_id' => $corpse->division_id,
                    'Division' => $corpse->station->division->division,
                    'Days' => $days = $this->storageday($corpse->pickup_date, $corpse->burial_date),
                    'Name' => $corpse->first_name . '  ' . $corpse->last_name
                );
            }




            if ($corpse->burial_date == '') {
                $notBuried[$corpse->division_id] = $corpse->station->division->division;
                $notBuriedCompact[] =  array(
                    'id' => $corpse->id,
                    'division_id' => $corpse->division_id,
                    'Division' => $corpse->station->division->division,
                    'Days' => $days = $this->storageday($corpse->pickup_date, $corpse->burial_date),
                    'Name' => $corpse->first_name . '  ' . $corpse->last_name
                );
            }


            if ($this->storageday($corpse->pickup_date, $corpse->burial_date)  >= 30 && $corpse->burial_date == '') {
                $overThirtyDays++;
                $now = date('Y-m-d'); // Carbon::now();

                $div[$corpse->division_id] = $corpse->station->division->division;

                $dataCompact[] =  array(
                    'id' => $corpse->id,
                    'division_id' => $corpse->division_id,
                    'Division' => $corpse->station->division->division,
                    'Days' => $days = $this->storageday($corpse->pickup_date, $corpse->burial_date),
                    'Name' => $corpse->first_name . '  ' . $corpse->last_name
                );
            }
        }
        $data = array(
            'totalCountPerDiv' => $dataCompact,
            'divisionName' => $div,
            'notBuriedName' => $notBuried,
            'totalCountNotBuriedCompact' => $notBuriedCompact,
            'pendingPostmortemName' => $pendingPostmortem,
            'ToatalPendingPostmortemCompact' => $pendingPostmortemCompact,
            'burial_NotApprovedName' => $burial_NotApproved,
            'totalBurial_NotApprovedCompact' => $burial_NotApprovedCompact
        );

        return    $data;
    }




    public function myChart()
    {
        $data = $this->divisionOverThirstyDays();

        $countTotalTimeDivAppear = [];
        //
        $pendingPostmortemName = [];
        $burial_NotApprovedName = [];
        $notBuriedDivNames=[];

        foreach ($data['totalCountPerDiv'] as $key => $value) {

            if ($value['division_id'] != null) {
                $countTotalTimeDivAppear[] = $value['division_id'];
            }
        }


        foreach ($data['totalCountNotBuriedCompact'] as $key => $value) {

            if ($value['division_id'] != null) {
                $notBuriedDivNames[] = $value['division_id'];
            }else{
                $notBuriedDivNames[] = $value['division_id'];
            }
        }



        foreach ($data['ToatalPendingPostmortemCompact'] as $key => $value) {

            if ($value['division_id'] != null) {
                $pendingPostmortemName[] = $value['division_id'];
            }
        }





        foreach ($data['totalBurial_NotApprovedCompact'] as $key => $value) {

            if ($value['division_id'] != null) {
                $burial_NotApprovedName[] = $value['division_id'];
            }
        }




        $charOne = array(
            'total_Count_per_division' => array_count_values($countTotalTimeDivAppear),
            'total_Count_per_NotBuried' => array_count_values($notBuriedDivNames),
            'total_Count_per_Pending' => array_count_values($pendingPostmortemName),
            'total_Count_per_NotApproved' => array_count_values($burial_NotApprovedName),
            'divisionName' => $data['divisionName'],
            'notBuriedDivNames' =>  $data['notBuriedName'],
            'pendingPostmortemName' => $data['pendingPostmortemName'],
            'burial_NotApprovedName' => $data['burial_NotApprovedName'],

        );
        return   $charOne;
    }




    public function burial_request()
    {
        $burial_request = 0;
        $corpses = Corpse::where('pauper_burial_approved', '=', 'Processing')->get();
        foreach ($corpses as $corpse) {
            $burial_request++;
        }
        return $burial_request;
    }


    public function burial_NotApproved()
    {
        $burial_NotApproved = 0;
        $corpses = Corpse::where('pauper_burial_approved', '=', 'No')->get();
        foreach ($corpses as $corpse) {
            $burial_NotApproved++;
        }
        return $burial_NotApproved;
    }

    public function post_mortem_pending()
    {
        $post_mortem_pending = 0;
        $corpses = Corpse::where('postmortem_status', '=', 'Pending')->get();
        foreach ($corpses as $corpse) {
            $post_mortem_pending++;
        }
        return $post_mortem_pending;
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

            'corpse_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'unidentified' => 'required',
            'last_name' => 'sometimes|min:2|max:15',
            'middle_name' => 'sometimes|max:15',
            'suspected_name' => 'sometimes|max:15',
            'first_name' => 'min:3|max:15',
            'dob' => 'sometimes|date',
            'dna_date' => 'sometimes|date',
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
            'pauper_burial_requested' => 'nullable|string',
            'buried' => 'nullable|string',
            'burial_date' => 'sometimes|date',
            'postmortem_status' => 'string',
            'postmortem_date' => 'sometimes|date',
            'funeralhome_id' => 'required',
            'pathlogist' => 'sometimes|string',
            'cause_of_Death' => 'sometimes|string',
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
                    $corpse->body_status = 'Claimed';
                }
                $corpse->last_name = $request->input('last_name');
                $corpse->middle_name = $request->input('middle_name');
                $corpse->first_name = $request->input('first_name');
                $corpse->suspected_name = $request->input('suspected_name');
                $corpse->dna = $request->input('dna');
                $corpse->dna_date = $request->input('dna_date');

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
                    $error_array = ['Error, Something occurred while saving!'];
                }

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

            'unidentified' => 'required',
            'last_name' => 'sometimes|min:2|max:15',
            'middle_name' => 'sometimes|max:15',
            'suspected_name' => 'sometimes|max:15',
            'first_name' => 'min:3|max:15',
            'dob' => 'sometimes|date',
            'dna_date' => 'sometimes|date',
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
            'cause_of_Death' => 'sometimes|string',

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
            if ($corpse->unidentified === "Yes") {
                $corpse->body_status = 'Unclaimed';
            } else {
                $corpse->body_status = 'Claimed';
            }
            $corpse->last_name =  $request->input('last_name');
            $corpse->middle_name =  $request->input('middle_name');
            $corpse->first_name =  $request->input('first_name');
            $corpse->suspected_name =  $request->input('suspected_name');
            $corpse->dna =  $request->input('dna');
            $corpse->dna_date =  $request->input('dna_date');

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

               }
                catch (\Throwable $th) {
                    $error_array = ['Error, occurred while updating !'];
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
        $funeralhomes = Funeralhome::all();
        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){
           $stations = Station::where('division_id', $auth_user_div_id)->get();
        }else{
            $stations = Station::get();
        }
        $conditions= Condition::get();
        $manners= Manner::get();
        $anatomies= Anatomy::get();
        $ranks =  Rank::all();
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
        $funeralhomes = Funeralhome::get();
        $stations = Station::get();
        $investigators = Investigator::where('corpse_id', '=', $this->test_input( $id))->get();
        $conditions= Condition::get();
        $manners= Manner::get();
        $anatomies= Anatomy::get();
        $ranks =  Rank::get();
        return view('corpses.edit', compact('corpse','funeralhomes', 'ranks','stations','conditions','manners','anatomies','investigators'));

       
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

    public function taskPost(Request $request)

    {

        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->address_to_id =    $this->test_input( $request->input('address_to_id'));
        $task->corpse_id =   $this->test_input( $request->input('corpse_id'));
        $task->task =   $this->test_input($request->input('task'));
        $task->modify_by = 0;
    try{
        $task->saveOrFail();
        }
        catch (\Throwable $th) {
        return ['error'=>' Something occurred while saving task !'];
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
        return ['error'=>' Something occurred while retrieving record!'];
        }

        return  response()->json(['Task notification sent successfully.']);
    }
    //////////////////////////////////////////////////////




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
