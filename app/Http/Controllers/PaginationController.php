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
 
use  Notification;
 

use function PHPSTORM_META\type;

use App\Http\Controllers\Log;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\where;
class PaginationController extends Controller
{

    public $exportCorpse=array();
    public  $regNo =null;
    function index()
    { 
                  // $corpses = Corpse::orderBy('created_at', 'desc')->get();
        // $funeralhomes = Funeralhome::get();
        // $auth_user_div_id= auth()->user()->station->division->id  ;
        // $parishes=Parish::get();
        // if(!auth()->user()->hasRole('SuperAdmin')){
        //    $stations = Station::where('division_id', $auth_user_div_id)->get();
        // }else{
        //     $stations = Station::get();
        // }


        // if(!auth()->user()->hasRole('SuperAdmin')){
        //     $divisions = Division::where('id', $auth_user_div_id)->get();
        //  }else{
        //     $divisions = Division::get();
        //  }
        //  $corpses=Corpse::paginate(5);
        //  $conditions= Condition::get();
        //  $manners= Manner::get();
        //  $anatomies= Anatomy::get();
        //  $ranks =  Rank::all();
        // return view('pagination', compact('funeralhomes', 'parishes','stations','conditions','manners','anatomies','divisions','corpses'))->render();

   

    }


   
    public function setExportList($list)
    {

        return  $this->exportCorpse=$list;
    }


    public function getExportList()
    {
        return $this->exportCorpse;
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

   
    function fetch_data(Request $request)
    {
 
 
        $sort_by ='';
        $sort_type = '';
    $datax = $request->except('_token'); 
  
  
    $auth_user_div_id= auth()->user()->station->division->id  ;
    $auth_user_divSingle ="where `users`.division_id = $auth_user_div_id ";
    
    $auth_user_divMult =" and `users`.division_id = $auth_user_div_id";
     $data = $request->except('_token');
     $except ='';
     $query = '';
     $count = 0;
     $search= false;
     $page = 0;

     $total_records =0;
     $record_per_page=2;
     $order_by_last_name = 'asc';
  

     foreach ($datax as $key => $value) {
        // $value =$this->test_input( $value);
        if($key=='sort_by' ) {
            $sort_by = $value; 
        }      
        if($key=='sort_type' ) {
            $sort_type = $value; 
        }
 



////////////////////////////////////////////////////////////////////////////////


     $value =$this->test_input( $value);

     if($key=='order_by_last_name') {

         if($value!='') {
               $order_by_last_name =$value;
         }else   {
         $order_by_last_name = 'asc';
         }

      }



     if($key=='page'||$key=='sort_by' ||$key=='sort_type'||$key=='order_by_last_name')
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


  try {

        if(!auth()->user()->hasRole('SuperAdmin')){
             if ($this->regNo != '') {
                 if ($this->countVal == 0) {
                     //HERE IS JUST run REGNUM ONLY
                     $corpses =  DB::select(DB::raw("SELECT DISTINCT  divisions.division, corpses.* FROM corpses INNER join `divisions` on `divisions`.id = `corpses`.division_id
                     INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                     INNER join `users` on `divisions`.id = `users`.division_id  where `users`.division_id= $auth_user_div_id
                     AND $this->regNo  ORDER BY created_at  LIMIT $start_from, $record_per_page "));
//0

   

                 } else if ($this->antherVariable == 1) {
                     $corpses =
                         DB::select(DB::raw("SELECT DISTINCT  divisions.division ,corpses.* FROM corpses
                         INNER join `divisions` on `divisions`.id = `corpses`.division_id
                         INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                         INNER join `users` on `divisions`.id = `users`.division_id  $query
                         AND  $this->regNo   $auth_user_divMult  ORDER BY created_at  LIMIT $start_from, $record_per_page "));

//1
            
                 } elseif ($this->antherVariable == 2) {

//2
                     $corpses =
                         DB::select(DB::raw("SELECT DISTINCT  divisions.division ,corpses.* FROM corpses
                         INNER join `divisions` on `divisions`.id = `corpses`.division_id
                         INNER join `investigators` on `investigators`.corpse_id = `corpses`.id
                         INNER join `users` on `divisions`.id = `users`.division_id
                         $query and $this->regNo   $auth_user_divMult  ORDER BY created_at  "));
 

                 }
             } else {
//3
            $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                                                    INNER join `divisions` on `divisions`.id = `corpses`.division_id
                                                    INNER join `users` on `divisions`.id = `users`.division_id   $query
                                                    AND  `users`.division_id= $auth_user_div_id  ORDER BY created_at   "));
 
 


           }


 } else {

     if ($this->regNo != '') {
         if ($this->countVal == 0) {
             //HERE IS JUST run REGNUM ONLY
             $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division, corpses.* FROM corpses
              INNER join `divisions` on `divisions`.id = `corpses`.division_id
              INNER join `investigators` on `investigators`.corpse_id = `corpses`.id where $this->regNo  ORDER BY created_at LIMIT $start_from, $record_per_page"));
 


         } else if ($this->antherVariable == 1) {

             $corpses =
                 DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                 INNER join `divisions` on `divisions`.id = `corpses`.division_id
                 INNER join `investigators` on `investigators`.corpse_id = `corpses`.id   $query AND  $this->regNo  ORDER BY created_at  LIMIT $start_from, $record_per_page "));
 



         } elseif ($this->antherVariable == 2) {

             $corpses =
                 DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses
                 INNER join `divisions` on `divisions`.id = `corpses`.division_id
                 INNER join `investigators` on `investigators`.corpse_id = `corpses`.id $query and $this->regNo  ORDER BY created_at   LIMIT $start_from, $record_per_page "));
 



         }
     } else {
  
        $corpses =  DB::select(DB::raw("SELECT DISTINCT divisions.division ,corpses.* FROM corpses INNER join `divisions` on `divisions`.id = `corpses`.division_id $query
                                        ")); 


     }


 }
 
} catch (\Throwable $th) {
    $error_array = ['Error, Something occurred while processing !'];
}
 

 $corpse_ids[]=null;
    //dd( $corpses); 
    if ($corpses!='') {
    foreach ($corpses as   $value) {
        $total_records++; 
        $corpse_ids[] =[$value->id];
    }
}
Session::put('getExportList',$corpses);
$this->setExportList($corpses);
$this->getExportList();
 
//  dd( $sort_by ." ". $sort_type); 

 $corpses=null;
 $corpses =  DB::table('corpses')->whereIn('id', $corpse_ids)->orderBy($sort_by, $sort_type)->paginate(10);
     return view('pagination_data', compact('corpses','total_records'))->render();
     }
 
 
}

