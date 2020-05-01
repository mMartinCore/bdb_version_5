<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Session;
use Illuminate\Http\Request;
use App\Corpse;
use App\User;
use App\Rank;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\customException;
use Yajra\DataTables\Facades\DataTables;

class LiveSearchController2 extends Controller
{

    public function __construct() {
        //$this->middleware(['auth']);
          $this->middleware(['clearance']);
    }

    function index()
    {
     return view('live_search.live_search');
    }









    function ajaxCall(Request $request)
    {
    $corpses =Corpse::query();
    return DataTables::of($corpses)->make(true);
    }






    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data =htmlentities( $data );
        $data = strip_tags( $data );

        //$data = mysql_real_escape_string($data);
        return $data;
    }



    function action(Request $request)
    {
      if($request->ajax())
      {
       $output = '';
       $rank ='';
       $query = $this->test_input($request->get('query'));
       $auth_user_div_id= auth()->user()->station->division->id  ;


       if($query != '')
       {

          

          $corpses = DB::table('corpses')
         
          ->orwhere('id', 'like', '%'.$query.'%')
          ->orWhere('cr_no', 'like', '%'.$query.'%')
          ->orWhere('unidentified', 'like', '%'.$query.'%')
          ->orWhere('last_name', 'like', '%'.$query.'%')
          ->orWhere('first_name', 'like', '%'.$query.'%')
          ->orWhere('middle_name', 'like', '%'.$query.'%')
          ->orWhere('suspected_name', 'like', '%'.$query.'%')
          ->orWhere('dob', 'like', '%'.$query.'%')
          ->orWhere('nationality', 'like', '%'.$query.'%')
          ->orWhere('pickup_location', 'like', '%'.$query.'%')
          ->orWhere('sex', 'like', '%'.$query.'%')
          ->orWhere('death_date', 'like', '%'.$query.'%')
          ->orWhere('address', 'like', '%'.$query.'%')
          ->orWhere('cause_of_Death', 'like', '%'.$query.'%')
          ->orWhere('dr_name', 'like', '%'.$query.'%')
          ->orWhere('pathlogist', 'like', '%'.$query.'%')
          ->orWhere('next_of_kin', 'like', '%'.$query.'%')
          ->orWhere('burial_date', 'like', '%'.$query.'%')
          ->orWhere('pickup_date', 'like', '%'.$query.'%')
          ->orderBy('id', 'desc')
          ->get();





       }
       else
       {
        $corpses = DB::table('corpses')
          ->orderBy('last_name', 'desc')
          ->get();
       }
       $total_row = $corpses->count();

       $name='';

       if($total_row > 0)
       {

         foreach($corpses as $Corpse)
        {
              
                if ($Corpse->first_name =='Unidentified') {
                    if ($Corpse->suspected_name!=''){
                            $name='* '.$Corpse->suspected_name.' *';
                        }else{
                            $name='Unidentified';
                        }
                   } else {
                         $name= $Corpse->first_name.'  '.$Corpse->middle_name.' '.$Corpse->last_name ;
                   }

                   
              if(!auth()->user()->hasRole('SuperAdmin')){
                      if ($Corpse->division_id==$auth_user_div_id) {
                           $output .= ' <h5> <a id="curlyStyle" href="#"  onclick="getViewId(' . $Corpse->id . ')" >'.$Corpse->cr_no.' '.   $name.'</a></h5><hr>  ';
                      }
              }else{
                $output .= ' <h5> <a id="curlyStyle" href="#"  onclick="getViewId(' . $Corpse->id . ')" >'.$Corpse->cr_no.' '.   $name.'</a></h5><hr>  ';
              } 
            
          }

        }
       }
       else
       {
        $output = '
        <br>
        <h4>No Data Found
         </h4>
        ';
       }
       $corpses = array(
        'table_data'  => $output,
        'total_data'  => $total_row
       );

       echo json_encode($corpses);
      }
    }




