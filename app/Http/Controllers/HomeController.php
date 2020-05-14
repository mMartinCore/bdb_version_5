<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Officer;
use App\User;
use DB;
use App\Posting;
use App\Skill;
use App\Promotion;
use App\Commendation;
use App\Catcommendation;
use App\Notifications\newCorpseNotification;
use Validator;
use App\Http\Requests\CreateCorpseRequest;
use App\Corpse;
use App\Division;
use Session;
use Flash;
use App\Funeralhome;
use Response;
use App\Station;
use App\Rank;
use App\Investigator;
use App\Listeners\SendPauperBurialRequestEmail;
use App\Listeners\SendWelcomeEmail;
use App\Events\pauperBurialRequest;
use App\Task;
use Carbon\Carbon;
 use Charts;
use App\Http\Controllers\Auth;
use App\Http\Controllers\mysql_real_escape_string;
use Illuminate\Notifications\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','minifiedPage']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');//->withSkills($skills)->withOfficers($officers)->withPostings($postings)->withAwards($awards);
    }




    public function storageday($pickupDate,$burialDate )
    {
        $pickup_date = Carbon::parse($pickupDate);
        $burial_date = Carbon::parse($burialDate);
        $now = Carbon::now();
        if (  $burialDate !=null || $burialDate !=null ) {
          return  $burial_date->diffInDays( $pickup_date );
        }else{
            $pickup_date = Carbon::parse($pickupDate);
            return $now->diffInDays( $pickup_date );
        }
    }



    public function overThirtyDaysStats()
    {

        $pieChartData = $this->myChart();

        $station_name = array();
        $totalCountPerStation = array();

        $total_Count_per_NotApproved = array();
        $total_per_division = array();
        $total_per_Div_NotBuried = array();
        $total_Count_per_Pending = array();
        $division_Name = array();
        $notBuriedDivNames = array();
        $burial_NotApprovedName = array();
        $pendingPostmortemName= array();



        foreach ($pieChartData['station_name'] as  $Name) {
            if ($Name != '') {
                $station_name[] = $Name;
            }
        }


        foreach ($pieChartData['total_Count_per_station'] as $key => $count) {

            $totalCountPerStation[] = $count;
        }





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

        $borderColors = [
            'red', 'green', 'blue', '#4D8066',   '#FF6633', 'orange',   'magenta',
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)", '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A',
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)",

              '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6',
            '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',

            '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
            '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC',
            '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
            '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680',
            '#E6FF80', '#1AFF33', '#999933',
            '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',
            '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];


        $bar_station = Charts::create('bar', 'highcharts')
            ->title('Bodies 30 Days and over per Station')
            ->elementLabel('Number of Bodies 30 Days  per Station and Not Buried')
            ->labels($station_name)
            ->values($totalCountPerStation)
             ->colors($borderColors)
            ->dimensions(1000, 500)

            ->backgroundcolor("#ECF0F5")
            ->responsive(true);






        $chart = Charts::create('donut', 'highcharts')
            ->title('Bodies Over 30 Days per Division')
            ->labels($division_Name)
            ->values($total_per_division)
            ->colors($borderColors)
            ->dimensions(1000, 500)
            ->responsive(true);


        $bar = Charts::create('bar', 'highcharts')
            ->title('Not Buried per Division')
            ->elementLabel(' Total Bodies Not Buried')
            ->labels($notBuriedDivNames)
            ->values($total_per_Div_NotBuried)
            ->colors($borderColors)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);





        $pie = Charts::create('pie', 'google')
            ->title('Post Mortem Pending per Division')
            ->elementLabel(' Total Pending  Post Mortem per Division ')
            ->labels($pendingPostmortemName)
            ->values($total_Count_per_Pending)
            ->colors($borderColors)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);

        $notApproved_bar = Charts::create('donut', 'google')
            ->title(' Pauper s Burial Not Approved per Division')
            ->elementLabel('Not Approved per Division')
            ->labels($burial_NotApprovedName)
            ->values($total_Count_per_NotApproved)
            ->colors($borderColors)
            ->dimensions(1000, 500)
            ->backgroundcolor("#ECF0F5")
            ->responsive(true);






        //$s=$this->divisionOverThirstyDays();

        $post_mortem_pending = $this->post_mortem_pending();
        $burial_request = $this->burial_request();
        $burial_NotApproved = $this->burial_NotApproved();
        $overThirtyDays =0;


        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){ 
            $corpses = cache()->remember('cache_key_dashboard',Session::get('caches_time'), function () use($auth_user_div_id) {
                return  Corpse::where('division_id', $auth_user_div_id)->where('pickup_date','!=',null)->where('body_status',"Unclaimed")->get();
            }); 
         }else{
            $corpses = cache()->remember('cache_key_dashboard',Session::get('caches_time'), function () {
                return  Corpse::where('pickup_date','!=',null)->where('body_status',"Unclaimed")->get();
            });
         
         }



      
        foreach ($corpses as $corpse) {
            if ($this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30  && $corpse->burial_date == null ) {

                $overThirtyDays++;
                //$storagedays[]=  array( 'id'=>$corpse->id, 'Days'=> $days= $this->storageday($corpse->pickup_date, $corpse->burial_date),'Name'=> $corpse->first_name.'  '.$corpse->last_name );
            }
        }






        return View('/home', compact('chart','bar_station', 'bar', 'pie', 'notApproved_bar', 'overThirtyDays', 'post_mortem_pending', 'burial_request', 'burial_NotApproved'))->render();
    }




    public function burial_request()
    {      $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){ 
            $corpses = cache()->remember('cache_key_dashboard_burial_request',Session::get('caches_time'), function () use($auth_user_div_id) {
                return    Corpse::where('division_id', $auth_user_div_id)->where('pauper_burial_approved', '=', 'Processing')->where('body_status',"Unclaimed")->get();
            });         
      
         }else{
            $corpses = cache()->remember('cache_key_dashboard_burial_request',Session::get('caches_time'), function ()   {
                return    Corpse::where('pauper_burial_approved', '=', 'Processing')->where('body_status',"Unclaimed")->get();  
            });
          
         }
        $burial_request = 0;     
        foreach ($corpses as $corpse) {
            $burial_request++; 
        }
        return $burial_request;
    }






    public function burial_NotApproved()
    {
        $burial_NotApproved = 0;
        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){ 
            $corpses = cache()->remember('cache_key_dashboard_burial_NotApproved',Session::get('caches_time'), function () use($auth_user_div_id) {
                return   Corpse::where('division_id', $auth_user_div_id)->where('pauper_burial_approved', '=', 'No')->where('body_status',"Unclaimed")->get();
                   });   
         }else{            
                 $corpses = cache()->remember('cache_key_dashboard_burial_NotApproved',Session::get('caches_time'), function ()   {
                   return  Corpse::where('pauper_burial_approved', '=', 'No')->where('body_status',"Unclaimed")->get();
             }); 
                
         }

 
        foreach ($corpses as $corpse) {
            $burial_NotApproved++;
        }
        return $burial_NotApproved;
    }

    public function post_mortem_pending()
    {
        $post_mortem_pending = 0;
        $auth_user_div_id= auth()->user()->station->division->id  ;
        if(!auth()->user()->hasRole('SuperAdmin')){ 
            $corpses = cache()->remember('cache_key_dashboard_post_mortem_pending',Session::get('caches_time'), function () use($auth_user_div_id) {
            return  Corpse::where('division_id', $auth_user_div_id)->where('postmortem_status', '=', 'Pending')->where('body_status',"Unclaimed")->get();
            });  

        }else{
                   $corpses = cache()->remember('cache_key_dashboard_post_mortem_pending',Session::get('caches_time'), function ()  {
                    return Corpse::where('postmortem_status', '=', 'Pending')->where('body_status',"Unclaimed")->get();
                });  
    
         } 
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



    public function divisionOverThirstyDays()
    {
        $corpses = cache()->remember('cache_key_dashboard_divisionOverThirstyDays',Session::get('caches_time'), function ()  {
            return  Corpse::where('body_status',"Unclaimed")->get();
            });  
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


            if ($this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30 && $corpse->burial_date == '') {
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
        $data_station= $this->stationOverThirstyDays();
        $countTotalTimeSationAppear=[];
        $countTotalTimeDivAppear = [];
        $notBuriedDivNames=[];
        $pendingPostmortemName = [];
        $burial_NotApprovedName = [];


        foreach ($data_station['totalCountPerStation'] as $key => $value) {

            if ($value['station_id'] != null) {
                $countTotalTimeSationAppear[] = $value['station_id'];
            }
        }


        foreach ($data['totalCountPerDiv'] as $key => $value) {

            if ($value['division_id'] != null) {
                $countTotalTimeDivAppear[] = $value['division_id'];
            }
        }


        foreach ($data['totalCountNotBuriedCompact'] as $key => $value) {

            if ($value['division_id'] != null) {
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
            'total_Count_per_station' => array_count_values($countTotalTimeSationAppear),
            'total_Count_per_division' => array_count_values($countTotalTimeDivAppear),
            'total_Count_per_NotBuried' => array_count_values($notBuriedDivNames),
            'total_Count_per_Pending' => array_count_values($pendingPostmortemName),
            'total_Count_per_NotApproved' => array_count_values($burial_NotApprovedName),
            'station_name'=>$data_station['station_name'],
            'divisionName' => $data['divisionName'],
            'notBuriedDivNames' =>  $data['notBuriedName'],
            'pendingPostmortemName' => $data['pendingPostmortemName'],
            'burial_NotApprovedName' => $data['burial_NotApprovedName'],

        );
        return   $charOne;
    }












///////////////////////////////////////////////////////////////////////////////////////////////////////////////////






public function stationOverThirstyDays()
{

    if(!auth()->user()->hasRole('SuperAdmin')){
        $corpses = cache()->remember('cache_key_dashboard_stationOverThirstyDays',Session::get('caches_time'), function ()  {
            return   Corpse::where('division_id', auth()->user()->station->division->id  )->where('body_status',"Unclaimed")->get();
        });
        }else {
            $corpses = cache()->remember('cache_key_dashboard_stationOverThirstyDays',Session::get('caches_time'), function ()  {
                return   Corpse::where('body_status',"Unclaimed")->get();
                });  
           
    }

    $overThirtyDays = 0;
    $dataCompact[] = null;
    $station_name[] = '';
    $dataStationCompact[]=null;

    foreach ($corpses as $corpse) {


        if ($this->storageday($corpse->pickup_date, $corpse->burial_date) >= 30 && $corpse->burial_date == '') {
            $overThirtyDays++;

            $station_name[$corpse->station_id ] = $corpse->station->station;

            $dataStationCompact[] =  array(
                'id' => $corpse->id,
                'station_id' => $corpse->station_id,
                'station' =>$corpse->station->station,
                'Days' => $days = $this->storageday($corpse->pickup_date, $corpse->burial_date),
                'Name' => $corpse->first_name . '  ' . $corpse->last_name
            );
        }
    }
    $data = array(
        'totalCountPerStation' => $dataStationCompact,
        'station_name' => $station_name
    );

    return    $data;
}








///////////////////////////////////////////////////////////////////////////////////
















































}
